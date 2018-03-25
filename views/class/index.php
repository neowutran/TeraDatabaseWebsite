<?php

use dosamigos\chartjs\ChartJs;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

$this->title = 'Class';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Class count</h1>
    <?php
    $dataset = [];
    $backgroundColor = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];
    $borderColor = [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
    ];

    echo "<h2>class usage statistics by region and date</h2>";

    $active = true;
	$items = [];

    foreach ($regions as $region => $data) {
        $i = 0;
        $dataset = [];
        foreach ($data as $date => $date_data) {

            $data_count = [];
            foreach ($date_data[1] as $count) {
                $data_count[] = $count;
            }

            $dataset[] = [
                'label' => $date,
                'backgroundColor' => $backgroundColor[$i % 6],
                'borderColor' => $borderColor[$i % 6],
                'borderWidth' => 1,
                'data' => $data_count,
            ];
            $i++;
        }

        $chart = ChartJs::widget([
            'type' => 'bar',
            'options' => [
                'responsive' => true,
                'title' => [
                    'display' => false,
                    'text' => $region . ' class usage statistics by date'
                ],
            ],

            'data' => [
                'labels' => $date_data[0],
                'datasets' => $dataset
            ]
        ]);

        $items[] = [
            'label' => $region,
            'content' => $chart,
            'active' =>$active
        ];
        $active = false;
    }

    echo Tabs::widget([
    'items' => $items
    ]);
    ?>
