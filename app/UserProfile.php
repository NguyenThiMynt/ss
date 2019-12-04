<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class UserProfile extends Authenticatable
{
    use Notifiable;
    protected $table = 'user_profile';
    protected $primaryKey = 'user_id';
    protected $guarded = [];
    protected $hidden = [
        'password_hash',
    ];
    protected $rememberTokenName = false;


    public $incrementing = false;

    public function getAuthPassword(){
        return $this->password_hash;
    }

    public static function findAdminByEmail($email)
    {
        $user = DB::table('user_profile')->select('user_profile.mail_address','user_profile.password')->where('mail_address','=',$email);
        return $user;

    }
}
