<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_login()
    {
        $data = [
            'email' => 'test@gmail.com',
            'password' => 'password'
        ];
        $response = $this->postJson('/api/admin/auth/login', $data);
        $response->assertOk();
    }

    public function test_admin_invalid()
    {
        $data = [
            'email' => 'test@gmail.com',
            'password' => 'password1'
        ];
        $response = $this->postJson('/api/admin/auth/login', $data);
        $response->assertStatus(302);
    }
}
