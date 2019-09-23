<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WeatherJsonTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('POST', '/api/weather/export_file', ['file_type' => 'json']);
        $file_name = "";
        if($data = json_decode((string)$response->getContent(), true)){
            if($data['code'] == 0){
                $file_name = $data['file_name'];
            }
        }
        Storage::disk('local')->assertExists($file_name);
    }
}
