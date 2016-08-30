<?php

namespace app\components;
use yii\base\Widget;
use app\models\DpsParsing;

class MenuWidget extends Widget
{
    private $_area;
    public $language;

    public function init()
    {
        parent::init();
        $area_list = DpsParsing::listArea($this->language);

        foreach ($area_list as $areaId => $areaName){
            $this->_area[] = ['label' => $areaName, 'url' => ['/dps/area/', "areaId" => $areaId]];
        }
    }

    public function run()
    {
        return serialize($this->_area);
    }
}