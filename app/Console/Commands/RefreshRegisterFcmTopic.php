<?php

namespace App\Console\Commands;

use App\Repositories\PushDestinationRepository;
use App\Services\FcmSenderService;
use App\UserProfile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RefreshRegisterFcmTopic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh-register-fcm-topic:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh register fcm topic';

    private $stepUser = 0;

    /**
     * @var FcmSenderService
     */
    private $fcmService;

    /**
     * @var PushDestinationRepository
     */
    private $pushRepos;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->fcmService = new FcmSenderService();
        $this->pushRepos = new PushDestinationRepository();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $allUsers = UserProfile::all();
        $this->stepUser = 0;
        foreach ($allUsers as $user) {

            $this->refreshRegisterTokenForUser($user);
            ++$this->stepUser;
        }
    }

    private function refreshRegisterTokenForUser($user)
    {
        Log::debug("register topics for user no: $this->stepUser, id=$user->user_id");

        $tokens = $this->pushRepos->getTokensOfUser($user->user_id);

        if (empty($tokens)) {
            Log::debug("user $user->user_id no have tokens");
            return;
        }

        // register topic user
        $topicNameOfTheUser = FcmSenderService::getTopicByUser($user->user_id);
        $this->fcmService->registerTopic($tokens, $topicNameOfTheUser);

        if ($user->trade_signal_flg == config('constant.db.trade_signal_flg.on')) {
            // register topic investor
            if (!empty($user->investor_id)) {
                // register topic for investor
                $topicName = FcmSenderService::getTopicByInvestorId($user->investor_id);
                Log::debug("registering token to topic investor: $topicName");
                $this->fcmService->registerTopic($tokens, $topicName);
            }

            // register topic color
            $tradeSignalSubTypeArray = explode(',', $user->trade_signal_sub_types);
            foreach ($tradeSignalSubTypeArray as $tradeSubType) {
                if (empty($tradeSubType)) {
                    continue;
                }
                $topicNameSubType = FcmSenderService::makeTopicNameBySubType($tradeSubType);
                Log::debug("registering token to topic subtype: $topicNameSubType");
                $this->fcmService->registerTopic($tokens, $topicNameSubType);
            }
        }
        Log::debug("end refresh $this->stepUser");
    }
}
