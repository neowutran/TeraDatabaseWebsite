<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use dosamigos\chartjs\ChartJs;
use yii\bootstrap\ActiveForm;

$this->title = 'Class by regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-content">

    <?php
    $dataset = [];
    $backgroundColor = [
        'EU' => 'rgba(255, 99, 132, 0.2)',
        'KR' => 'rgba(54, 162, 235, 0.2)',
        'TW' => 'rgba(255, 206, 86, 0.2)',
        'NA' => 'rgba(75, 192, 192, 0.2)',
        'RU' => 'rgba(153, 102, 255, 0.2)',
        'JP' => 'rgba(255, 159, 64, 0.2)'
    ];
    $borderColor = [
        'EU' => 'rgba(255,99,132,1)',
        'KR' => 'rgba(54, 162, 235, 1)',
        'TW' => 'rgba(255, 206, 86, 1)',
        'NA' => 'rgba(75, 192, 192, 1)',
        'RU' => 'rgba(153, 102, 255, 1)',
        'JP' => 'rgba(255, 159, 64, 1)',
    ];
    foreach ($data as $region => $region_data) {
        $data_count = [];
        foreach ($region_data[1] as $count) {
            $data_count[] = round(($count * 100) / $region_data[2], 3);
        }
        $dataset[] = [
            'label' => $region,
            'backgroundColor' => $backgroundColor[$region],
            'borderColor' => $borderColor[$region],
            'borderWidth' => 1,
            'data' => $data_count,
        ];
    }
    echo "<h1>class usage statistics by region</h1>";
    echo ChartJs::widget([
        'type' => 'bar',
        'options' => [
            "tooltipTemplate" => "<%if (label){%><%=label%>: <%}%><%= value %>kb",
            'responsive' => true,
            'title' => [
                'display' => false,
                'text' => 'Class usage statistics by region '
            ],
        ],

        'data' => [
            'labels' => $region_data[0],
            'datasets' => $dataset

        ]]);

    ?>
</div>
