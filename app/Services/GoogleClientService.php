<?php
/**
 * Created by PhpStorm.
 * User: sato
 * Date: 2019-06-13
 * Time: 15:55
 */

namespace App\Services;


use Google_Client;
use GuzzleHttp\Client;

class GoogleClientService
{
    const FIRE_BASE_SCOPE_EMAIL = "https://www.googleapis.com/auth/userinfo.email";
    const FIRE_BASE_SCOPE_REAL_TIME_DB = "https://www.googleapis.com/auth/firebase.database";
    const FIRE_BASE_SCOPE_CM = 'https://www.googleapis.com/auth/firebase.messaging';

    /**
     * @var Google_Client
     */
    protected $client;

    /**
     * @var Client
     */
    protected $httpClient = null;


    public function setup(){
        $this->client = new Google_Client();
        $this->client->useApplicationDefaultCredentials();
        $this->client->setAuthConfig(config('seminar.firebase.account_service_path'));
        $this->client->addScope([self::FIRE_BASE_SCOPE_CM]);
        $this->httpClient = $this->client->authorize();
    }

    /**
     * @return Client
     */
    public function getHttpClient(){
        return $this->httpClient;
    }
}