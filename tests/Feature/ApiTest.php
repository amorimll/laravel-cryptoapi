<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_ApiTest()
    {
        $response = $this->get('api/coin?coin=bitcoin');
        $response
            ->assertJsonStructure([
                'name',
                'price'
            ])
            ->assertStatus(200);
    }

    public function test_ApiByDateTest()
    {
        $response = $this->get('api/coin/history?coin=bitcoin&date=01-12-2022');
        $response
            ->assertJsonStructure([
                'name',
                'price',
                'date'
            ])
            ->assertStatus(200);
    }
}
