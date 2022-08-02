<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pengobatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengobatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pengobatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengobatan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>