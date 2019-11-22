<?php

namespace App\Console\Commands;

use App\Repositories\PushDestinationRepository;
use App\Services\FcmSenderService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteTokenFCMExpires extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:DeleteToken';

    /**
     * @var FcmSenderService
     */
    private $fcmSender;

    /**
     * @var PushDestinationRepository
     */
    private $pushDestinationRepo;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete token FCM expires';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->fcmSender = new FcmSenderService();
        $this->pushDestinationRepo = new PushDestinationRepository();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Crontab Command Detele Token');
        try {
            DB::beginTransaction();
            $q_token = $this->pushDestinationRepo->getAllToken();
            foreach ($q_token as $token) {
                Log::debug("checking FCM token: $token->token");
                $ret = $this->fcmSender->getUserFromToken($token->token);
                if ($ret === false) {
                    // delete DB token expired
                    $this->pushDestinationRepo->deleteTokenById($token->id);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
        }

    }
}
