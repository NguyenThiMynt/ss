<?php


namespace Tests\Feature;


use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * vendor/bin/phpunit --filter testloginSuccess tests/Feature/LoginTest.php
     */
    public function testloginSuccess(){
        $param = ['username' => 'vinhpd5', 'password' => 'Vinh12345'];
        $response = $this->json("post",'/api/v1/login',$param)
        ->assertStatus(200);

        $response->dump();
    }
    public function testloginErr(){
        $param = ['username' => 'testusername', 'password' =>'testpass'];

        $response = $this->json("post",'/api/v1/login',$param)
            ->assertStatus(400);

        $response->dump();
    }
}