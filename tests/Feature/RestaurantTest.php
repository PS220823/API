<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RestaurantTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_GET_restaurant_op_id()
    {
        $response = $this->get('api/restaurants/1');
        $response->assertStatus(200);
        $response->assertJson(['naam'=>'Bierkiet', ]);
    }
    public function test_POST_restaurant()
    {
        $data = ['soort_id'=>'1', 'naam'=>'Testcafé', 'eigenaar'=>'Testcafé', 'oprichtingsdatum'=>'2005-07-22', 'plaats'=>'Veldhoven'];
        $response = $this->json('POST','api/restaurants', $data);
        $response->assertStatus(201);
    }
    public function test_DELETE_restaurant()
    {
        $response = $this->delete('api/restaurants/1');
        $response->assertStatus(200);
    }
}
