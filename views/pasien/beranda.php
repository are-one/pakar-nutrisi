<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AhliGiziSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Beranda';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_lb"> <a href="<?= Url::home() ?>"> <i class="icon-dashboard"></i> Beranda </a> </li>
            <li class="bg_lg"> <a href="data_penyakit_solusi.php"><i class="icon-th"></i> Penyakit</a> </li>
            <li class="bg_ly"> <a href="data_gejala.php"> <i class="icon-inbox"></i> Pengobatan </a> </li>
            <li class="bg_lo"> <a href="rule_penyakit.php"> <i class="icon-pencil"></i> Diagnosis</a> </li>
        </ul>
    </div>
    <!-- <div class="row-fluid">
        <div class="span12" style="color: #326497;">
            <center>
                <h1>SPK</h1>
            </center>
        </div>
    </div> -->
</div>