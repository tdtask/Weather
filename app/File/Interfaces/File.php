<?php
namespace App\File\Interfaces;

use App\File\Models\Weather;

interface File
{
    public function save(Weather $weather): array;
    
    public function prepareData(Weather $weather): string;
}