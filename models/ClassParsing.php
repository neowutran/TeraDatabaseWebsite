<?php

namespace app\models;

use yii\base\Exception;

class ClassParsing extends Parsing
{

    public static function dateData($region)
    {

        if ($region != "EU" && $region != "NA" && $region != "KR" && $region != "RU" && $region != "JP" && $region != "TW" && $region != "THA" && $region != "KR-PTS") {
            throw new Exception("Go fuck yourself");
        }

        $result = [];
        $files = scandir(ClassParsing::$basedir . "class/" . $region . "/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^([0-9]+-[0-9]+)\.txt$#", $file, $matches)) {
                $result[$matches[1]] = ClassParsing::_parseFile("class/" . $region . "/" . $file);
            }
        }

        return $result;

    }

}
