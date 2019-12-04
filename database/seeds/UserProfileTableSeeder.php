<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profile')->insert([
        'user_id' => '1',
        'password_hash' => '$2b$10$VW/1Xy0vGZbw0h8TECHej.ALgOviSVh.VgGcMjxTVJerqucLwPpU6',
        'mail_address' => 'nguyenmy97bn@gmail.com',
        'first_name' => 'My',
        'last_name' => 'MyNguyen',
        'role' => config('constant.role.admin')
    ]);
    }
}
