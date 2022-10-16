<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creating_unique_user_request()
    {
        $data = [
            'email' => 'test1@gmail.com',
            'name' => 'test email',
            'password' => 'password'
        ];
        $response = $this->postJson('/api/admin/user/insert', $data);
        $result = $response->json();
        if(isset($result['message'])){
            $response->assertExactJson([
                "message" => "The email has already been taken.",
                "errors" => [
                    "email" => [
                        "The email has already been taken."
                    ]
                ]
            ]);
        }else{
            $response->assertCreated();
        }
    }


}
