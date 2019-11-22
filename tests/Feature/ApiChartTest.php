<?php


namespace Tests\Feature;


use Tests\TestCase;

class ApiChartTest extends TestCase
{
    /**
     * vendor/bin/phpunit --filter testDataSuccess tests/Feature/ApiChartTest.php
     */
    public function testDataSuccess(){

        $response = $this->json("get",'/api/v1/data-chart',['instrument' => 'USD_JPY', 'granularity' => 'M1'])
            ->assertStatus(200);

        $response->dump();
    }
}