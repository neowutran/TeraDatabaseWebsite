<?php

namespace app\controllers;

use app\models\DpsParsing;
use yii\web\Controller;
use yii\base\Exception;

class DpsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }

    public function actionArea($areaId){
        if(!preg_match("#^\d+$#", $areaId)){
            throw new Exception("Go fuck yourself");
        }
        $data = DpsParsing::listBoss($areaId ,"EU-EN");
        $areaName = DpsParsing::areaName($areaId, "EU-EN");
        return $this->render('area', ["listBoss"=>$data, "areaName"=>$areaName, "areaId"=>$areaId]);

    }

    public function actionBoss($areaId, $bossId){
        if(!preg_match("#^\d+$#", $areaId) ||
        !preg_match("#^\d+$#",$bossId)){
            throw new Exception("Go fuck yourself");
        }
        $areaName = DpsParsing::areaName($areaId, "EU-EN");
        $bossName = DpsParsing::bossName($areaId, $bossId, "EU-EN");
        $data = DpsParsing::bossData($areaId, $bossId);
        return $this->render('boss', ["data"=>$data,"areaName"=> $areaName, "areaId"=>$areaId, "bossName"=>$bossName, "bossId"=>$bossId ]);
    }

    public function actionGlobal()
    {
        $data = DpsParsing::globalData();
        return $this->render('global', ["data" => $data]);
    }

    public function actionClass()
    {
        $data = DpsParsing::classData();
        return $this->render('class', [
            "data" => $data,
        ]);

    }

    public function actionClasssum()
    {
        $data = DpsParsing::classData();
        return $this->render('classsum', [
            "data" => $data,
        ]);

    }

}
