<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\components\MenuWidget;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Tera Database Analysor',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $items = [];
    $items[]=  ['label' => 'Global', 'url' => ['/dps/global']];
    $items[] = ['label' => 'By class', 'url' => ['/dps/class']];
    $items[] = ['label' => 'By class - Sum', 'url' => ['/dps/classsum']];
    $list_boss = unserialize(MenuWidget::widget(['language' => 'EU-EN']));
    foreach ($list_boss as $area){
        $items[] = $area;
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Class', 'items' => [
                ['label' => 'Global', 'url' => ['/class/global']],
                ['label' => 'By region', 'url' => ['/class/region']],
                ['label' => 'By date - EU', 'url' => ['/class/date', 'region' => 'EU']],
                ['label' => 'By date - NA', 'url' => ['/class/date', 'region' => 'NA']],
                ['label' => 'By date - RU', 'url' => ['/class/date', 'region' => 'RU']],
                ['label' => 'By date - KR', 'url' => ['/class/date', 'region' => 'KR']],
                ['label' => 'By date - TW', 'url' => ['/class/date', 'region' => 'TW']],
                ['label' => 'By date - JP', 'url' => ['/class/date', 'region' => 'JP']],

            ]],
            ['label' => 'Dps statistics', 'items' => $items]

        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?><br>
        <!-- Tera Database Analysor -->
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Tera Database Analysor -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-5294805207003932"
             data-ad-slot="6369191497"
             data-ad-format="auto"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
</div>
<?php $this->endBody() ?>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-83201003-1', 'auto');
    ga('send', 'pageview');

</script>
</body>

</html>
<?php $this->endPage() ?>
