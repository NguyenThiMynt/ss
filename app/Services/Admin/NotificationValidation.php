<?php


namespace App\Services\Admin;


use Illuminate\Support\Facades\Validator;

class NotificationValidation
{
    public function validateNotification($request)
    {
        $rules = [
            'title_notification' => 'required|min:3|max:50',
        ];
        $messages = [
            'title_notification.required' => 'title không dduwwocj trống',
            'title_notification.min' => 'title phải chứa ít nhất từ 3 ký tự',
            'title_notification.max' => 'title tối đa là 50 kỹ tự',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        return $validation;
    }
}