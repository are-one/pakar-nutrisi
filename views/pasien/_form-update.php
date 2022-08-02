<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasien-form container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?= Html::a('Kembali', ['/pasien/index'], ['class' => 'btn btn-info btn-sm']) ?>

            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5><?= Html::encode($this->title) ?> </h5>
                </div>

                <div class="widget-content nopadding">
                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal'],
                        'errorCssClass' => 'error',
                    ]); ?>

                    <?= $form->field($model, 'nama', [
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
                                            ])->label('Nama : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'alamat', [
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
                                            ])->label('Alamat : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'umur', [
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
                                                'type' => 'number', 'min' => '0',
                                                'maxlength' => true, 'class' => 'span3', 'required' => true
                                            ])->label('Umur : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'usia_kandungan', [
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
                                                'type' => 'number', 'min' => '0',
                                                'maxlength' => true, 'class' => 'span3', 'required' => true
                                            ])->label('Usia Kandungan : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'pertambahan_bb', [
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
                                                'type' => 'number', 'min' => '0',
                                                'maxlength' => true, 'class' => 'span3', 'required' => true
                                            ])->label('Pertambahan BB : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'hb', [
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
                                            ])->label('HB : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'status', [
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
                                            ])->label('Status : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'email', [
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
                                            ])->label('Email : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'username', [
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
                                            ])->label('Username : ', ['class' => 'control-label']) ?>
                    <?= $form->field($model, 'password_baru', [
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
                                            ])->passwordInput([
                            'placeholder' => 'Password',
                            'data' => ['rule' => 'minlen:4', 'msg' => 'Please enter at least 8 chars of subject']
                        ])->label('Password : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'ulangi_password_baru', [
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
                                            ])->passwordInput([
                            'placeholder' => 'Ulangi Password',
                            'data' => ['rule' => 'minlen:4', 'msg' => 'Please enter at least 8 chars of subject']
                        ])->label('Ulangi Password : ', ['class' => 'control-label']) ?>

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