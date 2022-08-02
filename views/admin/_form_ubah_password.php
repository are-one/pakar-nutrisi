<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container-fluid">
    <?php if (Yii::$app->session->hasFlash("success")) : ?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash("success") ?>
        </div>
    <?php endif; ?>
    <div class="row-fluid">
        <div class="span12">
            <?= Html::a('Kembali', ['/pasien/index'], ['class' => 'btn btn-warning btn-sm']) ?>

            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5><?= Html::encode($this->title) ?> </h5>
                </div>

                <div class="widget-content nopadding">
                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal', 'id' => 'pasien-form'],
                        'errorCssClass' => 'error',
                    ]); ?>

                    <?= $form->field($model, 'password_lama', [
                        'template' => '
                    {label}
                    <div class="controls">
                            {input}
                            {error}
                    </div>
                    ',
                        'options' => [
                            'class' => 'control-group'
                        ],
                    ])->passwordInput([
                        'maxlength' => true,
                        'class' => 'span5', 'required' => true
                    ])->label($model->getAttributeLabel('password_lama') . ' : ', ['class' => 'control-label']) ?>


                    <?= $form->field($model, 'password', [
                        'template' => '
                    {label}
                    <div class="controls">
                            {input}
                            {error}
                    </div>
                    ',
                        'options' => [
                            'class' => 'control-group'
                        ],
                    ])->passwordInput([
                        'maxlength' => true,
                        'class' => 'span5', 'required' => true
                    ])->label($model->getAttributeLabel('password') . ' : ', ['class' => 'control-label']) ?>



                    <?= $form->field($model, 'ulangi_password', [
                        'template' => '
                    {label}
                    <div class="controls">
                            {input}
                            {error}
                    </div>
                    ',
                        'options' => [
                            'class' => 'control-group'
                        ],
                    ])->passwordInput([
                        'maxlength' => true,
                        'class' => 'span5', 'required' => true
                    ])->label($model->getAttributeLabel('ulangi_password') . ' : ', ['class' => 'control-label']) ?>



                    <!-- === AWAL BUTTON SUBMIT SIMPAN PENYAKIT === -->
                    <div class="form-actions">
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                        <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
                    </div>
                    <!-- === AKHIR BUTTON SUBMIT SIMPAN PENYAKIT === -->


                    <?php ActiveForm::end(); ?>

                </div>

            </div>
            <!-- END WIDGET BOX -->

        </div>
    </div>
</div>