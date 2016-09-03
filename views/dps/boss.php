<?php

use dosamigos\chartjs\ChartJs;
use yii\bootstrap\Tabs;

$this->title = 'DPS on '.$bossName;
$this->params['breadcrumbs'][] = $this->title;
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
?>
<div class="body-content">

    <h1>How to read this graph</h1>
    <p>
    <ul>
        <li>X axis: DPS in Million / Second</li>
        <li>Y axis: % of the playerbase doing the same DPS as the X value</li>
    </ul>
    </p>
    <?php

    $items = [];
    $itemsSum = [];
    foreach ($data as $class => $boss_data) {
        $i = 0;
        $data_count = [];
        $current_background = [];
        $sum_count = [];
        foreach ($boss_data[1] as $count) {
            $data_count[] = round((($count * 100) / $boss_data[2]), 3);
            $current_background[] = $backgroundColor[$i % 6];
            $current_border[] = $borderColor[$i % 6];
            if ($i == 0) {
                $sum_count[$i] = $count;
            } else {
                $sum_count[$i] = $count + $sum_count[$i - 1];
            }
            $i++;
        }

        $sum_percentage = [];
        $sum_percentage[] = "100";
        foreach ($sum_count as $sum) {
            $sum_percentage[] = round((($boss_data[2] - $sum) * 100) / $boss_data[2], 3);
        }

        $chart =  ChartJs::widget([
            'type' => 'bar',
            'options' => [
                'responsive' => true,
                'title' => [
                    'display' => false,
                    'text' => $bossName . ' dps'
                ],
                "tooltips" => [
                    "enabled" => false,
                ],
                "legend" => [
                    "display" => true
                ],
            ],

            'data' => [
                'labels' => $boss_data[0],
                'datasets' => [
                    [
                        'label' => $bossName . " boss ",
                        'backgroundColor' => $current_background,
                        'borderColor' => $current_border,
                        'borderWidth' => 1,
                        'data' => $data_count,
                    ],

                ]
            ]
        ]);


        $chartSum =  ChartJs::widget([
            'type' => 'bar',
            'options' => [
                'responsive' => true,
                'title' => [
                    'display' => false,
                    'text' => $bossName . ' dps'
                ],
                "tooltips" => [
                    "enabled" => false,
                ],
                "legend" => [
                    "display" => true
                ],
            ],

            'data' => [
                'labels' => $boss_data[0],
                'datasets' => [
                    [
                        'label' => $bossName . " boss ",
                        'backgroundColor' => $current_background,
                        'borderColor' => $current_border,
                        'borderWidth' => 1,
                        'data' => $sum_percentage,
                    ],

                ]
            ]
        ]);


        $active = false;
        if($class == "Global"){
            $active = true;
        }

        $items[] = [
            'label' => $class,
            'content' => $chart,
            'active' =>$active
        ];


        $itemsSum[] = [
            'label' => $class,
            'content' => $chartSum,
            'active' =>$active
        ];


    }
    ?>
    <h2>DPS</h2>
    <?php
    echo Tabs::widget([
    'items' => $items
    ]);
    ?>
    <h2>DPS sum</h2>
    <?php
    echo Tabs::widget([
        'items' => $itemsSum
    ]);
    ?>

</div>
