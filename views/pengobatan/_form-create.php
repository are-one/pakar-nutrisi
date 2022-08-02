<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pengobatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengobatan-form">
    <div class="container-fluid">

        <div class="row-fluid">
            <div class="span12">
                <?= Html::a('Kembali', ['/pengobatan/index'], ['class' => 'btn btn-info btn-sm']) ?>

                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5><?= Html::encode($this->title) ?> </h5>
                    </div>

                    <div class="widget-content nopadding">
                        <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal'],
                        'errorCssClass' => 'error',
                    ]); ?>

                        <?= $form->field($model, 'id_pengobatan', [
                                                'template' => '
                                            {label}
                                            <div class="controls">
                                                    {input}
                                                    {error}
                                            </div>
                                            ',
                                                'options' => [
                                                    'class' => 'control-group'
                                                ]
                                            ])->textInput([
                                                'maxlength' => true, 'class' => 'span3', 'required' => true
                                            ])->label('ID Pengobatan : ', ['class' => 'control-label'])  ?>

                        <?= $form->field($model, 'pengobatan', [
                                                'template' => '
                                            {label}
                                            <div class="controls">
                                                    {input}
                                                    {error}
                                            </div>
                                            ',
                                                'options' => [
                                                    'class' => 'control-group'
                                                ]
                                            ])->textInput([
                                                'maxlength' => true, 'class' => 'span3', 'required' => true
                                            ])->label('Pengobatan : ', ['class' => 'control-label'])  ?>

                        <div class="form-actions">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                            <?= Html::resetButton('Reset', ['class' => 'btn btn-warning']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>

    </div>