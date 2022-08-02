<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */

$this->title = 'Edit Pasien';
$this->params['breadcrumbs'][] = ['label' => 'Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pasien, 'url' => ['view', 'id' => $model->id_pasien]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pasien-update">

    <?= $this->render('_form-update', [
        'model' => $model,
    ]) ?>

</div>