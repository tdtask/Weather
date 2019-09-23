<?php

namespace App\File\Handlers;


use App\File\Interfaces\File;
use Illuminate\Support\Facades\Storage;
use App\File\Models\Weather;

class JsonFile implements File
{
    /**
     * @var string $file_name
     * */
    private $file_name = '_weather.json';

    public function save(Weather $weather): array
    {
        $data = self::prepareData($weather);
        $file_name = time() . $this->file_name;
        try{
            Storage::disk('local')->put($file_name, $data);
        }catch (\Exception $e){
            return ['error' => "Cannot save file. Desc: \"{$e->getMessage()}\""];
        }
        return ['file_name' => $file_name];
    }
    
    public function prepareData(Weather $weather): string 
    {
        return json_encode([
            'weather_date' => $weather->getDate(),
            'temperature' => $weather->getTemperature(),
            'wind_direction' => $weather->getWindDir(),
            'water_temperature' => $weather->getTemperatureWater(),
            'weather_condition' => $weather->getCondition(),
            'wind_speed' => $weather->getWindSpeed(),
            'pressure_mm' => $weather->getPressure(),
            'humidity' => $weather->getHumidity(),
        ], JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
    }

}