<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use dosamigos\chartjs\ChartJs;
use yii\bootstrap\ActiveForm;

$this->title = 'GlobalClass';
$this->params['breadcrumbs'][] = $this->title;

$data_count = [];
foreach ($data[1] as $count) {
    $data_count[] = round(($count * 100) / $data[2], 3);
}
?>
<div class="body-content">

    <h1>Global class usage statistics</h1>

    <?= ChartJs::widget([
        'type' => 'bar',
        'options' => [
            'responsive' => true,
            'title' => [
                'display' => false,
                'text' => 'Class counter'
            ],
        ],

        'data' => [
            'labels' => $data[0],
            'datasets' => [
                [

                    'label' => "Class counter",
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    'borderColor' => [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    'borderWidth' => 1,
                    'data' => $data_count,

                ],

            ]
        ]
    ]);
    ?>

</div>
