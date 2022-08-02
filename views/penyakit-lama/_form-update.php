<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Penyakit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row-fluid">
    <div class="span12">
        <?= Html::a('List Data Penyakit', ['/penyakit/index'], ['class' => 'btn btn-warning btn-sm']) ?>

        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5><?= Html::encode($this->title) ?> </h5>
            </div>

            <div class="widget-content nopadding">
                <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'form-horizontal'],
                    'errorCssClass' => 'error',
                ]); ?>

                <?= $form->field($model, 'nama_penyakit', [
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
                    'maxlength' => true,
                    'class' => 'span5', 'required' => true
                ])->label($model->getAttributeLabel('nama_penyakit') . ' : ', ['class' => 'control-label']) ?>

                <?= $form->field($model, 'deskripsi_penyakit', [
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
                ])->textarea(['rows' => 6])->label($model->getAttributeLabel('deskripsi_penyakit') . ' : ', [
                    'class' => 'control-label'
                ]);
                ?>


                <div class="form-actions">
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                    <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>