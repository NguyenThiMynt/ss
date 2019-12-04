<?php
/**
 * Created by PhpStorm.
 * User: sato
 * Date: 2019-06-13
 * Time: 16:37
 */

namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class PushDestinationRepository
{
    public function updateToken(string $token, string $userId)
    {
        DB::table('push_destination')
            ->updateOrInsert(
                ['token' => $token],
                ['user_id' => $userId]
            );
    }

    /**
     * @param $userId
     * @return array
     */
    public function getTokensOfUser($userId)
    {
        $results = DB::table("push_destination")->select('token')
            ->where('user_id', $userId)
            ->get();
        $tokens = [];
        foreach ($results as $row) {
            $tokens[] = $row->token;
        }
        return $tokens;
    }

    public function deleteToken($userId, $token = null)
    {
        $query = DB::table("push_destination")
            ->where('user_id', $userId);
        if ($token != null) {
            $query->where('token', $token);
        }
        $query->delete();
    }

    public function deleteTokenById($id)
    {
        DB::table("push_destination")
            ->where('id', $id)
            ->delete();
    }

    public function checkValidTokenOfUser($userId, $token)
    {
        return DB::table("push_destination")
                ->where('user_id', $userId)
                ->where('token', $token)->first() != null;
    }

    public function getAllToken()
    {
        return DB::table("push_destination")
            ->select('id', 'token')
            ->orderBy('created_at', 'ASC')
            ->get();
    }
}