<?php

namespace App\File\Handlers;


use App\File\Interfaces\File;
use Illuminate\Support\Facades\Storage;
use App\File\Models\Weather;

class XmlFile implements File
{
    /**
     * @var string $file_name
     * */
    private $file_name = '_weather.xml';
    
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
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<root>
    <weather_date>{$weather->getDate()}</weather_date>
    <wind_speed>{$weather->getWindSpeed()}</wind_speed>
    <temperature>{$weather->getTemperature()}</temperature>
    <humidity>{$weather->getHumidity()}</humidity>
    <wind_direction>{$weather->getWindDir()}</wind_direction>
    <water_temperature>{$weather->getTemperatureWater()}</water_temperature>
    <weather_condition>{$weather->getCondition()}</weather_condition>
    <pressure_mm>{$weather->getPressure()}</pressure_mm>
</root>";
    }
}