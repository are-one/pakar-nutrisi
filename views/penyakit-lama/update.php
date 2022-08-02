<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penyakit */

$this->title = 'Edit Data Penyakit: ' . $model->id_penyakit;
$this->params['breadcrumbs'][] = ['label' => 'Penyakits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_penyakit, 'url' => ['view', 'id' => $model->id_penyakit]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container-fluid">

    <?= $this->render('_form-update', [
        'model' => $model,
    ]) ?>

</div>