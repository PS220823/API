<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SoortTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_GET_soort_op_id()
    {
        $response = $this->get('api/soorten/1');
        $response->assertStatus(200);
        $response->assertJson(['soort'=>'Café',]);
    }
    public function test_GET_soorten()
    {
        $response = $this->get('api/soorten');
        $response->assertStatus(200);
        $response->assertJsonCount(6);
    }
}
