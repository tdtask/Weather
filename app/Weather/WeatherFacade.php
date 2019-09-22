<?php

namespace App\Weather;


use App\File\Interfaces\File;
use App\File\Models\Weather;
use App\Weather\Handlers\WeatherRequest;

class WeatherFacade
{
    /**
     * @var File $file
     * */
    protected $file;

    /**
     * @var WeatherRequest $request
     * */
    protected $request;
    
    public function __construct(File $file, WeatherRequest $request)
    {
        $this->file = $file;
        $this->request = $request;
    }
    
    public function getData():array 
    {
        return $this->request->send();
    }
    
    public function saveDataToFile(Weather $weather) :array
    {
        return $this->file->save($weather);
    }
}