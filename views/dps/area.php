<?php

use yii\bootstrap\Nav;

$this->title = 'Boss of '.$areaName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-content">
    <?php
    $items = [];
    foreach ($listBoss as $bossId => $bossName){
        $items[] =  ['label' => $bossName,'url' => ['dps/boss/', "areaId"=> $areaId , "bossId" => $bossId] ,'linkOptions'=>['class' => 'presentation'],];
    }
    echo Nav::widget([
        'items' => $items,
    'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled
    ]);

    ?>
</div>
