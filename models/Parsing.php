<?php

namespace app\models;

use yii\base\Model;

abstract class Parsing extends Model
{
    protected static $basedir = "/home/http/neowutran-website/web/data/";

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