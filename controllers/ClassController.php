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


    public function actionGlobal()
    {
        $data = ClassParsing::globalData();
        return $this->render('global', ["data" => $data]);
    }

    public function actionRegion()
    {
        $data = ClassParsing::regionData();
        return $this->render('region', [
            "data" => $data,
        ]);

    }

    public function actionDate($region)
    {
        $data = ClassParsing::dateData($region);
        return $this->render('date', [
            "data" => $data,
            "region" => $region,
        ]);

    }
}
