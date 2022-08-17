<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AhliGizi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ahli-gizi-form container-fluid">

    <div class="row-fluid">
        <div class="span12">

            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5><?= Html::encode($this->title) ?> </h5>
                </div>

                <div class="widget-content nopadding">
                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal'],
                        'errorCssClass' => 'error',
                    ]); ?>

                    <?php $form->field($model, 'id_ahli', [
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
                                            ])->label($model->getAttributeLabel('id_ahli') . ' : ', ['class' => 'control-label']) ?>

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
                                            ])->label($model->getAttributeLabel('username') . ' : ', ['class' => 'control-label']) ?>

                    <?php // $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

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
                                            ])->label($model->getAttributeLabel('email') . ' : ', ['class' => 'control-label']) ?>

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
                                            ])->label($model->getAttributeLabel('nama') . ' : ', ['class' => 'control-label']) ?>

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
                                            ])->label($model->getAttributeLabel('alamat') . ' : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'jenis_kelamin', [
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
                                            ])->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => '','class' => 'span3'])
                                            ->label($model->getAttributeLabel('jenis kelamin') . ' : ', ['class' => 'control-label']) ?>

                    <?= $form->field($model, 'foto', [
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
                                            ])->textInput(['maxlength' => true])
                                            ->label($model->getAttributeLabel('Foto') . ' : ', ['class' => 'control-label']) ?>

                    <div class="form-actions">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>

</div>