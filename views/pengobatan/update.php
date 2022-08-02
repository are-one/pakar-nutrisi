<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengobatan */

$this->title = 'Edit Pengobatan';
$this->params['breadcrumbs'][] = ['label' => 'Pengobatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pengobatan, 'url' => ['view', 'id' => $model->id_pengobatan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengobatan-update">

    <?= $this->render('_form-update', [
        'model' => $model,
    ]) ?>

</div>