<?php

namespace App\Http\Controllers\Admin;
use App\Notification;
use App\Services\Admin\NotificationValidation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    private $validation;
    public function __construct(NotificationValidation $notificationValidation)
    {
        $this->validation = $notificationValidation;
    }
    public function showListNotification()
    {
        $notifications = Notification::where('delete_flg', config('constant.db.exist_flg'))->orderBy('created_at', 'asc')->paginate(config('constant.paginate'));
        $links = $notifications->appends(['perPage' => config('constant.paginate')]);
        return view('notifications.index',['notifications'=>$notifications, 'links' => $links]);
    }

    public function createNotification(Request $request)
    {
        $data = [];
        if (!empty($request->notification_id)) {
            $notiId = $request->notification_id;
            $data = Notification::find($notiId);
        }

        return view('notifications.create',['data'=>$data]);
    }

    public function postNotification(Request $request)
    {
        try {
            Log::info('Start Notification');
            $validator = $this->validation->validateNotification($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->messages(),
                ],200);
            }
            $userId = Auth::user()->user_id;
            $notiId = $request->notification_id;
            $title = $request->input('title_notification');
            dd(html_entity_decode($request->input('txt_notification')));
            $content = !empty($request->input('txt_notification')) ? $request->input('txt_notification') : '';
            $data = [
                'user_id' => $userId,
                'title' => $title,
                'html_content' => $content,
                'plain_text_content' => ''
            ];
            if (!empty($notiId)) {
                Notification::where('notification_id', $notiId)->update($data);
            }
            else{
                Notification::insert($data);
            }
            Log::info('Start Notification');
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insert thành công',
                ],200);
            }
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ],400);
        }
    }

}
