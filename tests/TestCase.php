<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public static function login($test, $password)
    {
        $data = [
            'email' => 'test@gmail.com',
            'password' => $password
        ];
        return $test->postJson('/api/admin/auth/login', $data);
    }
}
