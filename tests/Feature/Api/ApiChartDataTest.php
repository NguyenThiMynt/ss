<?php
/**
 * Created by PhpStorm.
 * User: sato
 * Date: 2019-07-24
 * Time: 10:13
 */

namespace Tests\Feature\Api;


use Tests\TestCase;

class ApiChartDataTest extends TestCase
{
    /**
     * vendor/bin/phpunit --filter testDataSuccess tests/Feature/Api/ApiChartDataTest.php
     */
    public function testDataSuccess()
    {

        $headers = ["Authorization" => "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJjZjhmZTFkMS0yNzMzLTQ4ZmItYWQ1NS02ZWUwYTVjNDQ5NDMiLCJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS92MS9sb2dpbiIsImlhdCI6MTU2MzkzODI0NywiZXhwIjoxNTc5NDkwMjQ3LCJuYmYiOjE1NjM5MzgyNDcsImp0aSI6InIxT0x0dThBZjIwVlNCcjQifQ.jpOvJZkAM_6i2j5TOCmK0hFKwFBSJInBOls7Gr2gQhY",
            "Accept" => "application/json"];

        $response = $this->json("GET", '/api/v1/data-chart',
            ['instrument' => 'USD_JPY', 'granularity' => 'M15', 'limit' => 3], $headers);
//            ->assertStatus(200);

        $response->dump();
    }
}