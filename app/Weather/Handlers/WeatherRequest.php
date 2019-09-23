<?php

namespace App\Weather\Handlers;
use GuzzleHttp\Client;

class WeatherRequest
{
    /**
     * @var Client $http_client.
     * */
    private $http_client;
    /**
     * @var string $url.
     * */
    private $url = "https://api.weather.yandex.ru/v1/informers";
    /**
     * @var array $add_data.
     * */
    private $add_data = [
        // Spb lon and lat
        'lon' => '30.241164',
        'lat' => '59.917219',
        'lang' => 'ru_RU',
    ];
    /**
     * @var string $api_key.
     * */
    private $api_key = 'b97b787a-9fc2-4aa6-b126-f18f9415d8a0';
    
    public function __construct()
    {
        $this->http_client = new Client();
    }
    
    public function send(): array
    {
        try{
            $response = $this->http_client->request('GET', $this->url, [
                'query' => $this->add_data,
                'headers' => [
                    'X-Yandex-API-Key' => $this->api_key,
                ]
            ]);
            $data = $response->getBody()->getContents();
        }catch (\Exception $e){
            return ['error' => "Cannot call weather api. Desc: \"{$e->getMessage()}\""];
        }
        if($data = json_decode($data, true)){
            $data = $data['fact'];
        }else{
            $data = ['error' => 'Cannot get weather api data'];
        }
        return $data;
    }
}