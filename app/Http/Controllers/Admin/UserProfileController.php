<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginRequest;
use App\Services\Admin\RegisterUserValidation;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class UserProfileController extends Controller
{
    private $validation;
    public function __construct(RegisterUserValidation $registerUserValidation)
    {
        $this->validation = $registerUserValidation;
    }
    public function login()
    {
        return view('login.index');
    }

    public function postLogin(LoginRequest $request){

        $email = $request->input('email');
        $password = $request->input('password');

        $user = UserProfile::findAdminByEmail($email);
        if(empty($user)){
            $notice = ' アクセス権限がありません。';
            return redirect()->back()->withInput(['notice' => $notice, 'email' => $email, 'password' => $password]);
        }
        $remember = !empty($request->input('remember')) ? true : false;

        $valid = Auth::attempt(['mail_address' => $email, 'password' => $password],$remember);
        if ($valid) {
            return redirect()->route('calendar.index');
        } else {
            $notice = 'メールアドレスまたはパスワードが間違っています。';
            return redirect()->back()->withInput(['notice' => $notice, 'email' => $email, 'password' => $password]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function showListUser()
    {
        $users = UserProfile::where('delete_flg', config('constant.db.exist_flg'))->where('role', '<>', config('constant.role.admin'))->orderBy('created_at', 'asc')->paginate(config('constant.paginate'));
        $links = $users->appends(['perPage' => config('constant.paginate')]);
        return view('customers.index',['users'=>$users, 'links' => $links]);
    }

    public function createUser(Request $request)
    {
        $usserId = $request->user_id;
        $data = [];
        if (!empty($usserId)) {
            $data = UserProfile::find($usserId);
        }
        return view('customers.create', ['data' => $data]);
    }

    public function registerUser(Request $request)
    {
        try {
            Log::info('Start registerUser');
            $validator = $this->validation->validateRegister($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->messages(),
                ], 200);
            }
            $userID = $request->user_id;
            $firstName = $request->input('first_name');
            $lastName = $request->input('last_name');
            $email = $request->input('email');
            $password = $request->input('password');
            $isAdmin = $request->isAdmin ? config('constant.role.admin') : config('constant.role.free_user');
            $data = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'mail_address' => $email,
                'password_hash' => bcrypt($password, ['round' => 10]),
                'role' => $isAdmin
            ];
            if (!empty($userID)) {
                UserProfile::where('user_id', $userID)->update($data);
            } else {
                $userId = Uuid::uuid4()->toString();
                $data['user_id'] = $userId;
                UserProfile::insert($data);
            }
            Log::info('Start registerUser');
            return response()->json([
                'success' => true,
                'message' => 'Insert thanh cong',
            ], 200);
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $userIds = $request->user_id;
            if(empty($userIds)){
                return response()->json([
                    'success' => false,
                    'errors' => 'Chưa chọn user nào để xóa',
                ], 200);
            }
            $arrayUserId = explode(',', $userIds);
            UserProfile::whereIn('user_id', $arrayUserId)->update(['delete_flg' => config('constant.db.delete_flg')]);
            return response()->json([
                'success' => true,
                'message' => 'Xóa thanh cong',
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
