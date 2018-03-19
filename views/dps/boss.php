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
    foreach ($data as $class => $dataRegions){
        foreach ($dataRegions as $region => $dataRegion) {
            $active = true;
            $items = [];
            foreach ($dataRegion as $date => $data){

                $i = 0;
                $data_count = [];
                $current_background = [];
                $current_border = [];
                $sum_count = [];
                foreach ($data[1] as $count) {
                    $data_count[] = round((($count * 100) / $data[2]), 3);
                    $current_background[] = $backgroundColor[$i % 6];
                    $current_border[] = $borderColor[$i % 6];
                    if ($i == 0) {
                        $sum_count[$i] = $count;
                    } else {
                        $sum_count[$i] = $count + $sum_count[$i - 1];
                    }
                    $i++;
                }

                $chart =  ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'responsive' => true,
                        'title' => [
                            'display' => false,
                            'text' => $bossName . ' - '. $date
                        ],
                        "tooltips" => [
                            "enabled" => false,
                        ],
                        "legend" => [
                            "display" => true
                        ],
                    ],

                    'data' => [
                        'labels' => $data[0],
                        'datasets' => [
                            [
                                'label' => $bossName . " - " . $region . " - ". $class,
                                'backgroundColor' => $current_background,
                                'borderColor' => $current_border,
                                'borderWidth' => 1,
                                'data' => $data_count,
                            ],

                        ]
                    ]
                ]);

                $items[] = [
                    'label' => $date,
                    'content' => $chart,
                    'active' =>$active
                ];

                $active = false;

            }
            echo "<h2> $class - $region </h2>";
            echo Tabs::widget([
                'items' => $items
            ]);
        }
    }
    ?>
</div>
