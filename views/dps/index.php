<?php

use dosamigos\chartjs\ChartJs;
use yii\bootstrap\Tabs;

$this->title = 'DPS';
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
    <h1>How to read this graph</h1>
    <p>
    <ul>
        <li>X axis: DPS in Million / Second</li>
        <li>Y axis: % of the playerbase doing the same DPS as the X value</li>
    </ul>
    </p>
