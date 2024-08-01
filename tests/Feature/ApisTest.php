<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApisTest extends TestCase
{

    protected $customer;
    public function __construct()
    {
        $this->customer =  "api/customer";
    }

    /**
     * A basic feature customer apis.
     */
    public function test_inquirie(): void
    {
        $response = $this->post("/{$this->customer}/send-inquirie");
        $response->assertStatus(200);
    }

    public function test_meetings(): void
    {
        $response = $this->get("/{$this->customer}/meetings");
        $response->assertStatus(200);
    }
    public function test_meetingById(): void
    {
        $response = $this->get("/{$this->customer}/meetings/meeting/1");
        $response->assertStatus(200);
    }
}
