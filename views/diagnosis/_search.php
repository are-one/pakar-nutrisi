<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\DiagnosisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diagnosis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_diagnosis') ?>

    <?= $form->field($model, 'pengobatan_id_pengobatan') ?>

    <?= $form->field($model, 'penyakit_id_penyakit') ?>

    <?= $form->field($model, 'hasil_diagnosis') ?>

    <?= $form->field($model, 'kondisi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
