<?php

namespace app\controllers;

use app\models\ClassParsing;
use yii\web\Controller;

class ClassController extends Controller
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

    public function actionIndex()
    {
        $regions = [];
        $global = ClassParsing::globalData();
        $globalRegion = ClassParsing::regionData();
        $regions["EU"] =  ClassParsing::dateData("EU");
        $regions["NA"] = ClassParsing::dateData("NA");
        $regions["RU"] = ClassParsing::dateData("RU");
        $regions["TW"] = ClassParsing::dateData("TW");
        $regions["KR"] = ClassParsing::dateData("KR");
		$regions["JP"] = ClassParsing::dateData("JP");
		$regions["THA"] = ClassParsing::dateData("THA");
		$regions["KR-PTS"] = ClassParsing::dateData("KR-PTS");

        return $this->render('index', [
            "globalRegion" => $globalRegion,
            "global" => $global,
            "regions" => $regions
        ]);

    }
}
