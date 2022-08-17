<?php

use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\helpers\Html;


?>
<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <i class="icofont-clock-time"></i> Monday - Saturday, 8AM to 10PM
        </div>
        <div class="d-flex align-items-center">
            <i class="icofont-phone"></i> Call us now +1 5589 55488 55
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <!-- <a href="<?= Url::to(['site/index']) ?>" class="logo mr-auto"><img src="assets2/img/logo2.png" alt=""></a> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <h1 class="logo mr-auto"><a href="index.html">Fuzzy Tsukamoto</a></h1>

        <nav class="nav-menu d-none d-lg-block">
            <?=
            Nav::widget([
                'options' => ['class' => false],
                'items' => [
                    ['label' => 'Home','options' => ['class' => 'mr-auto'], 'url' => ['/site/index'], 'active' => false],
                    // ['label' => 'Diagnosa Penyakit', 'url' => ['/site/diagnosa-penyakit'], 'visible' => !Yii::$app->pasien->isGuest],
                    // ['label' => 'Informasi', 'url' => ['/site/informasi']],
                    // ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Login','options' => ['class' => 'pull-right'], 'url' => ['/site/login'], 'active' => Yii::$app->controller->action->id == 'login'],
                    ['label' => 'Daftar', 'url' => ['/site/daftar'], 'visible' => Yii::$app->pasien->isGuest && Yii::$app->user->isGuest],
                ],
            ]);
            ?>
        </nav><!-- .nav-menu -->


    </div>
</header>