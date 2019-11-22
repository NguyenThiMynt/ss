<?php


namespace Tests\Feature;


use Tests\TestCase;

class SignupTest extends TestCase
{
    public function testSignupSuccess(){
        $param = [
            'user_id' =>'sdsds111',
            'first_name'=>'test1',
            'last_name' => 'test 2',
            'user_name' => 'testusername1',
            'password' => 'testpassword',
        ];
        $response = $this->json("post",'/api/v1/signup',$param)
            ->assertStatus(200);

        $response->dump();
    }
    public function testSignupErr(){
        $param = [
            'user_id' =>'sdsds111',
            'first_name'=>'test1test1',
            'last_name' => 'test 2',
            'user_name' => 'testusername1',
            'password' => 'testpassword',
        ];
        $response = $this->json("post",'/api/v1/signup',$param)
            ->assertStatus(400);

        $response->dump();
    }
}