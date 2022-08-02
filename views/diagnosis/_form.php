<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Diagnosis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diagnosis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_diagnosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengobatan_id_pengobatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'penyakit_id_penyakit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hasil_diagnosis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kondisi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
