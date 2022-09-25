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
        $response = $this->login($this, 'password');
        $response->assertOk();
    }

    public function test_admin_invalid()
    {
        $response = $this->login($this, 'password1');
        $response->assertStatus(302);
    }

    public function test_user_details()
    {
        $response = $this->getJson('/api/admin/user/details');
        $response->assertStatus(200);
    }

    public function test_check_user()
    {
        $response = $this->getJson('/api/admin/auth/check-user');
        $response->assertOk();
    }

}
