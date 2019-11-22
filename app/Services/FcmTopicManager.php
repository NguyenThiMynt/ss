<?php
/**
 * Created by PhpStorm.
 * User: sato
 * Date: 2019-06-28
 * Time: 13:29
 */

namespace App\Services;


use App\Repositories\PushDestinationRepository;
use Illuminate\Support\Facades\Log;

class FcmTopicManager
{
    /**
     * @var FcmSenderService
     */
    private $fcmService;

    /**
     * @var PushDestinationRepository
     */
    private $pushRepos;

    public function __construct()
    {
        $this->fcmService = new FcmSenderService();
        $this->pushRepos = new PushDestinationRepository();
    }

    /**
     * Unregister old topic and register new topic
     * @param $userId
     * @param $oldInvestorId
     * @param $newInvestorId
     */
    public function switchTopicByChangeInvestor($userId, $oldInvestorId, $newInvestorId)
    {
        $tokens = $this->pushRepos->getTokensOfUser($userId);

        if (empty($tokens)) {
            return;
        }

        if (!empty($oldInvestorId)) {
            $oldTopicName = FcmSenderService::getTopicByInvestorId($oldInvestorId);
            $this->fcmService->unRegisterTopic($tokens, $oldTopicName);
        }

        if (!empty($newInvestorId)) {
            $topicName = FcmSenderService::getTopicByInvestorId($newInvestorId);
            $this->fcmService->registerTopic($tokens, $topicName);
        }
    }

    public function unregisterUserToTopic($userId, $investorId)
    {
        if (empty($investorId)) {
            return;
        }

        $tokens = $this->pushRepos->getTokensOfUser($userId);
        if (empty($tokens)) {
            return;
        }

        $oldTopicName = FcmSenderService::getTopicByInvestorId($investorId);
        $this->fcmService->unRegisterTopic($tokens, $oldTopicName);
    }

    public function registerUserToTopic($userId, $investorId)
    {
        if (empty($investorId)) {
            return;
        }

        $tokens = $this->pushRepos->getTokensOfUser($userId);

        if (empty($tokens)) {
            return;
        }

        $topicName = FcmSenderService::getTopicByInvestorId($investorId);
        $this->fcmService->registerTopic($tokens, $topicName);
    }

    public function registerUserToTopicSubType($userId, $subType)
    {
        if (empty($subType)) {
            return;
        }

        $tokens = $this->pushRepos->getTokensOfUser($userId);
        if (empty($tokens)) {
            return;
        }

        $topicName = FcmSenderService::makeTopicNameBySubType($subType);
        Log::debug("registering token to topic subtype $topicName");
        $this->fcmService->registerTopic($tokens, $topicName);

    }

    public function unRegisterUserToTopicSubType($userId, $subType)
    {
        if (empty($subType)) {
            return;
        }

        $tokens = $this->pushRepos->getTokensOfUser($userId);
        if (empty($tokens)) {
            return;
        }

        $topicName = FcmSenderService::makeTopicNameBySubType($subType);
        Log::debug("unregistering token to topic subtype $topicName");
        $this->fcmService->unRegisterTopic($tokens, $topicName);
    }

}