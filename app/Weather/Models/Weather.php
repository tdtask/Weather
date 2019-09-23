<?php

namespace App\File\Models;


class Weather
{
    /**
     * @var int $temp Температура (°C).
     * */
    private $temp;
    /**
     * @var int $temp_water Температура воды (°C)
     * */
    private $temp_water;
    /**
     * @var string $condition Код расшифровки погодного описания. Возможные значения в getConditionDescription()
     * */
    private $condition;
    /**
     * @var int $wind_speed Скорость ветра (в м/с).
     * */
    private $wind_speed;
    /**
     * @var string $wind_dir Направление ветра. Возможные значения: в getWindDirDescription()
     * */
    private $wind_dir;
    /**
     * @var int $pressure_mm Давление (в мм рт. ст.)
     * */
    private $pressure_mm;
    /**
     * @var string $humidity Влажность воздуха (в процентах).
     * */
    private $humidity;
    /**
     * @var string $obs_time Время замера погодных данных в формате Unixtime.
     * */
    private $obs_time;
    
    /**
     * @var array $conditions Возможные варианты погодных условий.
     * */
    private $conditions = [
        'clear'                            => 'ясно',
        'partly-cloudy'                    => 'малооблачно',
        'cloudy'                           => 'облачно с прояснениями',
        'overcast'                         => 'пасмурно',
        'partly-cloudy-and-light-rain'     => 'небольшой дождь',
        'partly-cloudy-and-rain'           => 'дождь',
        'overcast-and-rain'                => 'сильный дождь',
        'overcast-thunderstorms-with-rain' => 'сильный дождь, гроза',
        'cloudy-and-light-rain'            => 'небольшой дождь',
        'overcast-and-light-rain'          => 'небольшой дождь',
        'cloudy-and-rain'                  => 'дождь',
        'overcast-and-wet-snow'            => 'дождь со снегом',
        'partly-cloudy-and-light-snow'     => 'небольшой снег',
        'partly-cloudy-and-snow'           => 'снег',
        'overcast-and-snow'                => 'снегопад',
        'cloudy-and-light-snow'            => 'небольшой снег',
        'overcast-and-light-snow'          => 'небольшой снег',
        'cloudy-and-snow'                  => 'снег'
    ];
    /**
     * @var array $directions Возможные варианты направления ветра.
     * */
    private $directions = [
        'nw' => 'северо-западное',
        'n'  => 'северное',
        'ne' => 'северо-восточное',
        'e'  => 'восточное',
        'se' => 'юго-восточное',
        's'  => 'южное',
        'sw' => 'юго-западное',
        'w'  => 'западное',
        'с'  => 'штиль',
    ];
    
    public function __construct(array $data)
    {
        $this->temp = (int)$data['temp'];
        $this->temp_water = (int)$data['temp_water'];
        $this->condition = (string)$data['condition'];
        $this->wind_speed = (int)$data['wind_speed'];
        $this->wind_dir = (string)$data['wind_dir'];
        $this->pressure_mm = (int)$data['pressure_mm'];
        $this->humidity = (int)$data['humidity'];
        $this->obs_time = (string)$data['obs_time'];
    }
    
    public function getDate()
    {
        return $this->obs_time;
    }
    
    public function getTemperature()
    {
        return $this->temp;
    }
    
    public function getWindDir()
    {
        return $this->wind_dir;
    }

    public function getTemperatureWater()
    {
        return $this->temp_water;
    }

    public function getCondition()
    {
        return $this->condition;
    }

    public function getWindSpeed()
    {
        return $this->wind_speed;
    }

    public function getPressure()
    {
        return $this->pressure_mm;
    }

    public function getHumidity()
    {
        return $this->humidity;
    }

    public function getConditionDescription(): string
    {
        if(array_key_exists($this->condition, $this->conditions)){
            return $this->conditions[$this->condition];
        }
        return "";
    }

    public function getWindDirDescription(): string
    {
        if(array_key_exists($this->wind_dir, $this->directions)){
            return $this->directions[$this->wind_dir];
        }
        return "";
    }
    
    public function getConvertDate()
    {
        return date('d.m.Y H:i', $this->obs_time);
    }
}