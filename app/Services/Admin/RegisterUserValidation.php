<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;

class RegisterUserValidation
{
    function validateRegister($request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:user_profile,mail_address,'.$request->user_id.',user_id',
        ];
        if (empty($request->user_id)) {
            $rules['password'] = 'required|min:8|max:50';
        }
        $messages = [
            'first_name.required'=>'familynaem khoong troongs',
            'last_name.required'=>'username khoong troongs',
            'email.required'=>'email khoong troongs',
            'email.unique'=>'email khong duoc trung',
            'email.email'=>'email khong dung dinh dang',
            'password.required'=>'password khoong troongs',
            'password.min'=>'password do dai toi thieu laf 8 kys tu',
            'password.max'=>'password do dai toi da la 50 ky tu',
        ];
        $validation = Validator::make($request->all(),$rules,$messages);
        return $validation;
    }


}
