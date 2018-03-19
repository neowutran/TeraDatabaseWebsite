<?php

namespace app\models;

use yii\base\Exception;
use yii\base\Model;

abstract class Parsing extends Model
{
    protected static $basedir = "/home/http/neowutran-website/web/data/";

    public static function boss($language){
        if(
            $language !== "EU-EN" &&
            $language !== "EU-FR" &&
            $language !== "EU-GER" &&
            $language !== "JP" &&
            $language !== "KR" &&
            $language !== "RU" &&
			$language !== "TW" &&
			$language !== "THA" &&
			$language !== "KR-PTS" &&
            $language !== "NA"
        ){
            throw new Exception("Go fuck yourself");
        }
        return simplexml_load_file("/home/http/neowutran-website/web/TeraDpsMeterData/monsters/monsters-".$language.".xml");
    }

    protected static function _parseFile($file)
    {
        $class = file_get_contents(Parsing::$basedir . $file);
        $class_data = [];
        $count = 0;
        foreach (explode("\n", $class) as $line) {
            $data = explode(":", $line);
            if (sizeof($data) != 2) {
                continue;
            }
            $class_data[$data[0]] = $data[1];
            $count += $data[1];
        }
        ksort($class_data);
        return [array_keys($class_data), array_values($class_data), $count];
    }

}
