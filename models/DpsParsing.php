<?php

namespace app\models;

use yii\base\Exception;

class DpsParsing extends Parsing
{

    public static function bossData($areaId, $bossId)
    {

        if( !preg_match("#^\d+$#", $areaId) ||
            !preg_match("#^\d+$#",$bossId)){
            throw new Exception("Go fuck yourself");
        }
		
		$list_class = scandir(Parsing::$basedir . "dps/".$areaId."-".$bossId."/");
        foreach ($list_class as $class) {

            if($class == "." || $class == "..") continue;
            $regions = scandir(Parsing::$basedir . "dps/".$areaId."-".$bossId."/".$class."/");
            foreach ($regions as $region) {
                if($region == "." || $region == "..") continue;
                $dates = scandir(Parsing::$basedir . "dps/".$areaId."-".$bossId."/".$class."/".$region."/");
                foreach ($dates as $date) {
                    $matches = [];
                    if (preg_match("#^(.+)\.txt$#", $date, $matches)) {
                        $result_class[$class][$region][$matches[1]] = Parsing::_parseFile("dps/" . $areaId . "-" . $bossId . "/" . $class . "/" . $region . "/" . $date);
                    }
                }
            }
        }

        return $result_class;
	}

    public static function areaName($areaId, $language){

        $translation = Parsing::boss($language);
        $translationKR = Parsing::boss("KR");

        $translation = json_encode($translation);
        $translation = json_decode($translation,TRUE);

        $translationKR = json_encode($translationKR);
        $translationKR = json_decode($translationKR,TRUE);

        $areaName = "";
        foreach ($translation["Zone"] as $zone){
            if($zone["@attributes"]["id"] == $areaId){
                return $zone["@attributes"]["name"];
            }
        }

        if($areaName == ""){
            foreach ($translationKR["Zone"] as $zone){
                if($zone["@attributes"]["id"] == $areaId){
                    return $areaName = $zone["@attributes"]["name"];
                }
            }
        }

        throw new Exception("Go fuck yourself");

    }

    public static function bossName($areaId, $bossId, $language){

        $translation = Parsing::boss($language);
        $translationKR = Parsing::boss("KR");

        $translation = json_encode($translation);
        $translation = json_decode($translation,TRUE);

        $translationKR = json_encode($translationKR);
        $translationKR = json_decode($translationKR,TRUE);

        $areaName = "";
        foreach ($translation["Zone"] as $zone){
            if($zone["@attributes"]["id"] == $areaId){
                foreach ($zone["Monster"] as $monster){
                    if($monster["@attributes"]["id"] == $bossId){
                        return $monster["@attributes"]["name"];
                    }
                }
            }
        }

        if($areaName == ""){
            foreach ($translationKR["Zone"] as $zone){
                if($zone["@attributes"]["id"] == $areaId){
                    foreach ($zone["Monster"] as $monster){
                        if($monster["@attributes"]["id"] == $bossId){
                            return $monster["@attributes"]["name"];
                        }
                    }
                }
            }

        }

        throw new Exception("Go fuck yourself");

    }

    public static function listBoss($areaId, $language){

        $translation = Parsing::boss($language);
        $translationKR = Parsing::boss("KR");

        $translation = json_encode($translation);
        $translation = json_decode($translation,TRUE);

        $translationKR = json_encode($translationKR);
        $translationKR = json_decode($translationKR,TRUE);

        $result = [];
        $files = scandir(Parsing::$basedir . "dps/by_boss/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^".$areaId."\.(\d+)\.txt$#", $file, $matches)) {

                $bossId = $matches[1];
                $bossName = "";
                foreach ($translation["Zone"] as $zone){
                    if($zone["@attributes"]["id"] == $areaId){
                        foreach ($zone["Monster"] as $monster){
                            if($monster["@attributes"]["id"] == $bossId){
                                $bossName = $monster["@attributes"]["name"];
                                break;
                            }
                        }
                        break;
                    }
                }

                if($bossName == ""){
                    foreach ($translationKR["Zone"] as $zone){
                        if($zone["@attributes"]["id"] == $areaId){
                            foreach ($zone["Monster"] as $monster){
                                if($monster["@attributes"]["id"] == $bossId){
                                    $bossName = $monster["@attributes"]["name"];
                                    break;
                                }
                            }
                            break;
                        }
                    }
                }

                $result[$bossId] = $bossName;

            }
        }
        return $result;
    }

    public static function listArea($language){

        $translation = Parsing::boss($language);
        $translationKR = Parsing::boss("KR");

        $translation = json_encode($translation);
        $translation = json_decode($translation,TRUE);

        $translationKR = json_encode($translationKR);
        $translationKR = json_decode($translationKR,TRUE);

        $result = [];
        $files = scandir(Parsing::$basedir . "dps/by_boss/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^(\d+)\.\d+\.txt$#", $file, $matches)) {

                $areaId = $matches[1];
                $areaName = "";
                foreach ($translation["Zone"] as $zone){
                    if($zone["@attributes"]["id"] == $areaId){
                        $areaName = $zone["@attributes"]["name"];
                        break;
                    }
                }

                if($areaName == ""){
                    foreach ($translationKR["Zone"] as $zone){
                        if($zone["@attributes"]["id"] == $areaId){
                            $areaName = $zone["@attributes"]["name"];
                            break;
                        }
                    }
                }

                $result[$areaId] = $areaName;

            }
        }
        return $result;
    }

}
