<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penyakit */

$this->title = 'Tambah Data Penyakit';
$this->params['breadcrumbs'][] = ['label' => 'Penyakits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <?= $this->render('_form-create', [
        'model' => $model,
        'modelPenyebabPenyakits' => $modelPenyebabPenyakits,
        'modelPenangananPenyakits' => $modelPenangananPenyakits,
    ]) ?>

</div>