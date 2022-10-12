<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaypalTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_paypal_payment()
    {
        $response = $this->postJson('/api/admin/paypal/handle-payment');
        $result = $response->json();
        $response->assertCreated();
    }

    public function test_create_product()
    {
        $data = [
            "name" => "Video Streaming Service",
            "description" => "Video streaming service",
            "type" => "SERVICE",
            "category" => "SOFTWARE",
            "image_url" => "https://example.com/streaming.jpg",
            "home_url" => "https://example.com/home"
        ];
        $response = $this->postJson('/api/admin/paypal/create-product', $data);
        $result = $response->json();
        $response->assertCreated();
    }
}
