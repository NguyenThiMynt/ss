<?php
/**
 * Created by PhpStorm.
 * User: sato
 * Date: 2019-06-13
 * Time: 16:10
 */

namespace App\Services;


use Illuminate\Support\Facades\Log;

class FcmSenderService
{

    const DEFAULT_TOPIC_ADD_SUBSCRIPTION_API_URL = 'https://iid.googleapis.com/iid/v1:batchAdd';
    const DEFAULT_TOPIC_REMOVE_SUBSCRIPTION_API_URL = 'https://iid.googleapis.com/iid/v1:batchRemove';

    /**
     * @var GoogleClientService
     */
    private $googleClientSv;

    /**
     * @var string
     */
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('FCM_SERVER_KEY');

        $this->googleClientSv = new GoogleClientService();
        $this->googleClientSv->setup();
    }


    public function  sendBody($bodyData){
        $project = env("FIREBASE_PROJECT_ID", "seminar");
        Log::debug("sending fcm message");
        Log::debug($bodyData['message']['data']);
        $response = $this->googleClientSv->getHttpClient()
            ->post("https://fcm.googleapis.com/v1/projects/{$project}/messages:send",
                ['json' => $bodyData]);

        Log::debug("send fcm message response:");
        Log::debug("response code:" . $response->getStatusCode());
        Log::debug($response->getBody());
        if($response->getStatusCode() != 200){
            return false;
        }
        return true;
    }

    /**
     * @param $topic
     * @param $title
     * @param $content
     * @param $dataKey
     * @param $data
     * @return bool
     */
    public function sendToTopic($topic, $title, $content, $dataKey, $data)
    {
        Log::debug("sending FCM to topic: $topic");

        return $this->sendTo([
            'key' => 'topic',
            'value' => $topic
        ], $title, $content, $dataKey, $data);
    }

    /**
     * @param $topics
     * @param $title
     * @param $content
     * @param $dataKey
     * @param $data
     * @return bool
     */
    public function sendToClientMustInManyTopics($topics, $title, $content, $dataKey, $data)
    {
        Log::debug("sendToClientMustInManyTopics");
        $condition = $this->makeConditionStrAndTopics($topics);
        return $this->sendToCondition($condition, $title, $content, $dataKey, $data);
    }

    /**
     * @param $topics
     * @return string
     */
    public function makeConditionStrAndTopics($topics)
    {
        $topicConditions = collect($topics)->map(function ($topicName) {
            return "'$topicName' in topics";
        })->toArray();
        $condition = join(' && ', $topicConditions);
        return $condition;
    }

    /**
     * @param $condition
     * @param $title
     * @param $content
     * @param $dataKey
     * @param $data
     * @return bool
     */
    public function sendToCondition($condition, $title, $content, $dataKey, $data)
    {
        Log::debug("sending FCM to condition: $condition");

        return $this->sendTo([
            'key' => 'condition',
            'value' => $condition
        ], $title, $content, $dataKey, $data);

    }


    /**
     * @param $arrayTo
     * @param $title
     * @param $content
     * @param $dataKey
     * @param $data
     * @return bool
     */
    public function sendTo($arrayTo, $title, $content, $dataKey, $data)
    {
        $message = [
            "message" => [
                $arrayTo['key'] => $arrayTo['value'],
                "notification" => [
                    "body" => $content,
                    "title" => $title,
                ],
                "android" => [
                    "ttl" => "360000s",
                    "priority" => "high",
                    "notification" => [
                        "sound" => "default"
                    ]
                ],

                "apns" => [
                    "headers" => [
                        "apns-priority" => "10"
                    ],
                    "payload" => [
                        "aps" => [
                            "badge" => 0,
                            "sound" => "default"
                        ]
                    ],
                ],
                "data" => [
                    $dataKey => json_encode($data),
                ]

            ]
        ];
        Log::debug(\GuzzleHttp\json_encode($message));

        return $this->sendBody($message);
    }

//    public function sendToTo($to, $title, $content, $data){
//
//    }


    /**
     * @param $token
     * @param $title
     * @param $content
     * @param $data
     * @return bool
     */
    public function sendToToken($token, $title, $content, $data){

        $message = [
            "message" => [
                "token" => $token,
                "notification" => [
                    "body" => $content,
                    "title" => $title,
                ],
                "android" => [
                    "ttl"=> "360000s",
                    "priority"=> "high",
                    "notification" => [
                        "sound"=> "default"
                    ]
                ],

                "apns"=> [
                    "headers"=> [
                        "apns-priority"=> "10"
                    ],
                    "payload" => [
                        "aps" => [
                            "badge"=> 0,
                            "sound" => "default"
                        ]
                    ],
                ],
                "data" => [
                    'trade_signal' => json_encode($data),
                ]

            ]
        ];
        return $this->sendBody($message);

    }

    public function getUserFromToken($token) {
        $ch = curl_init();
        $url = "https://iid.googleapis.com/iid/info/$token?details=true";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: key=" . env('FCM_SERVER_KEY')]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        Log::debug("Google response: " . $httpCode);
        Log::debug($data);
        if($httpCode === 404){
            return false;
        } else {
            return $data;
        }

    }

    public static function  getTopicByInvestorId(string $investorId){
        $env = env("APP_ENV");
        return "$env.topic.iv.$investorId";
    }

    public static function getTopicByUser(string $userId)
    {
        $env = env("APP_ENV");
        return "$env.topic.user.$userId";
    }

    public static function makeTopicNameBySubType($tradeSubType)
    {
        $env = env("APP_ENV");
        return "$env.topic.sub_type.$tradeSubType";
    }

    public function registerTopic($tokens, string $topicName)
    {
        Log::debug("registerTopic: $topicName");
        $url = self::DEFAULT_TOPIC_ADD_SUBSCRIPTION_API_URL;
        $this->processTopicSubscription($topicName, $tokens, $url);
    }

    public function unRegisterTopic($tokens, string $topicName)
    {
        Log::debug("unRegisterTopic: $topicName");
        $url = self::DEFAULT_TOPIC_REMOVE_SUBSCRIPTION_API_URL;
        $this->processTopicSubscription($topicName, $tokens, $url);
    }

    protected function processTopicSubscription($topicName, $tokens, $url){

        if (!is_array($tokens))
            $tokens = [$tokens];


        Log::debug("processTopicSubscription: token count " . count($tokens));
        $client = new \GuzzleHttp\Client();
        $response =  $client->post(
            $url,
            [
                'headers' => [
                    'Authorization' => sprintf('key=%s', $this->apiKey),
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    'to' => '/topics/' . $topicName,
                    'registration_tokens' => $tokens,
                ])
            ]
        );

        $result = $response->getBody()->getContents();
        Log::debug($result);
    }

}