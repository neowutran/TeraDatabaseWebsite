<?php

namespace app\models;

use yii\base\Exception;

class DpsParsing extends Parsing
{

    public static function globalData()
    {
        return ClassParsing::_parseFile("dps/total.txt");
    }

    public static function classData()
    {
        $result = [];
        $files = scandir(ClassParsing::$basedir . "dps/by_class/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^(.+)\.txt$#", $file, $matches)) {
                $result[$matches[1]] = ClassParsing::_parseFile("dps/by_class/" . $file);
            }
        }
        return $result;
    }

    public static function bossData()
    {
        $result = [];
        $files = scandir(ClassParsing::$basedir . "dps/by_boss/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^(.+)\.txt$#", $file, $matches)) {
                $result[$matches[1]] = ClassParsing::_parseFile("dps/by_boss/" . $file);
            }
        }
        return $result;
    }

    public static function dateData($region)
    {

        if ($region != "EU" && $region != "NA" && $region != "KR" && $region != "RU" && $region != "JP" && $region != "TW") {
            throw new Exception("Go fuck yourself");
        }

        $result = [];
        $files = scandir(ClassParsing::$basedir . "class/" . $region . "/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^([0-9]{4}-[0-9]{2})\.txt$#", $file, $matches)) {
                $result[$matches[1]] = ClassParsing::_parseFile("class/" . $region . "/" . $file);
            }
        }

        return $result;

    }

}