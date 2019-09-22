<?php

namespace App\File;


use App\File\Handlers\JsonFile;
use App\File\Handlers\XmlFile;

class FileFactory
{
    // Types of files
    const TYPE_JSON = 'json';
    const TYPE_XML  = 'xml';
    
    public static function getJsonFile()
    {
        return new JsonFile();
    }
    
    public static function getXmlFile()
    {
        return new XmlFile();
    }
    
    public static function getTypes()
    {
        return [self::TYPE_JSON, self::TYPE_XML];
    }
}