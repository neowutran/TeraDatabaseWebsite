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

    public static function bossData($areaId, $bossId)
    {

        if( !preg_match("#^\d+$#", $areaId) ||
            !preg_match("#^\d+$#",$bossId)){
            throw new Exception("Go fuck yourself");

        }

        $result = [];
        $files = scandir(ClassParsing::$basedir . "dps/by_boss/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^".$areaId."\.".$bossId."\.txt$#", $file, $matches) === 1) {
                $result["Global"] = ClassParsing::_parseFile("dps/by_boss/" . $file);
                break;
            }
        }

        if(empty($result["Global"])){
            throw new Exception("Go fuck yourself");
        }

        $files = scandir(ClassParsing::$basedir . "dps/by_class_boss/".$areaId.".".$bossId."/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^(.+)\.txt$#", $file, $matches)) {
                $result[$matches[1]] = ClassParsing::_parseFile("dps/by_class_boss/".$areaId.".".$bossId."/" . $file);
            }
        }
        return $result;
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
        $files = scandir(ClassParsing::$basedir . "dps/by_boss/");
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
        $files = scandir(ClassParsing::$basedir . "dps/by_boss/");
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