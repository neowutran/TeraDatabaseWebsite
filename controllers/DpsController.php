<?php

namespace app\controllers;

use app\models\DpsParsing;
use yii\web\Controller;

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
