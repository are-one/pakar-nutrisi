<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use app\assets\AdminAsset;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body style="background-color: #083139;">
    <?php $this->beginBody() ?>


    <!--Header-part-->
    <div id="header" style="background-color: #4A6B73;">
        <!-- <h2><a href="<?= Url::to(['site/index']) ?>">SPK</a></h2> -->
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <div id="user-nav" class="navbar" style="color: #f4f4f4; font-size:20pt; margin-top: 1.8%;">
        SISTEM PAKAR KEBUTUHAN NUTRISI IBU HAMIL
        <!-- <h3 style=" color: #f4f4f4; margin-left: 280px;">SISTEM PAKAR KEBUTUHAN NUTRISI IBU HAMIL</h3> -->
    </div>

    <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
        <?= Nav::widget([
            'options' => ['class' => false, 'style' => 'background-color: #083139;', 'tag' => 'ul'],
            'encodeLabels' => false,
            'activateParents' => true,
            'items' => [
                [
                    'label' => '<i class="icon icon-home"></i> <span>Beranda</span>',
                    'url' => ['/ahli-gizi/beranda'],

                ],
                [
                    'label' => '<i class="icon icon-signal"></i> <span>Ubah Profil</span>',
                    'url' => ['/ahli-gizi/ubah-profil'],
                ],


                [
                    'label' => '<i class="icon icon-glass"></i> <span>Mengelola Data Pasien</span>',
                    'url' => ['/pasien/index']
                ],
                [
                    'label' => '<i class="icon icon-gift"></i> <span>Mengelola Data Penyakit</span></a>',
                    'url' => ['/penyakit/index']
                ],
                [
                    'label' => '<i class="icon icon-gift"></i> <span>Mengelola Data Pengobatan</span></a>',
                    'url' => ['/pengobatan/index']
                ],
                // [
                //     'label' => '<i class="icon icon-gift"></i> <span>Ubah Password</span></a>',
                //     'url' => ['/admin/ubah-password']
                // ],
                Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login']]) : ('<li>'

                    . Html::a(
                        '<i class="icon icon-key"></i> Logout (' . Yii::$app->user->identity->username . ')',
                        ['/admin/logout'],
                        [
                            'data' => ['method' => 'post']
                        ]
                    )
                    . '</li>')
            ],
        ]); ?>
        <!-- <ul style="background-color: #083139;">
            <li> <a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
            <li> <a href="data_penyakit_solusi.php"><i class="icon icon-signal"></i> <span>Penyakit Dan Penanganan</span></a> </li>
            <li> <a href="data_gejala.php"><i class="icon icon-pencil"></i> <span>Gejala</span></a> </li>
            <li> <a href="rule_penyakit.php"><i class="icon icon-glass"></i> <span>Relasi</span></a> </li>
            <li> <a href="laporan_user.php"><i class="icon icon-gift"></i> <span>Laporan User</span></a> </li>
            <li> <a href="proses_logout.php"><i class="icon icon-user"></i> <span>Logout</span></a> </li>
        </ul> -->
    </div>
    <div id="content">
        <?= $content ?>
    </div>
    <!--Footer-part-->
    <div class="row-fluid">
        <div id="footer" class="span12"> 2020 &copy; Edited by <a href="#">Yii Developer</a> </div>
    </div>

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>