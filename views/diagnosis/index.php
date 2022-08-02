<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DiagnosisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Form Diagnosis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diagnosis-index">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <?php if(Yii::$app->session->hasFlash('error')){ ?>
                <div class="alert alert-danger">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
                <?php }elseif(Yii::$app->session->hasFlash('success')){ ?>
                <div class="alert alert-success">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5><?= Html::encode($this->title) ?> </h5>
                    </div>

                    <div class="widget-content nopadding">
                        <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal'],
                        'errorCssClass' => 'error',
                    ]); ?>

                        <?= $form->field($model, 'usia_ibu_hamil', [
                                                'template' => '
                                            {label}
                                            <div class="controls">
                                                    {input} Usia
                                                    {error}
                                                    </div> 
                                            ',
                                                'options' => [
                                                    'class' => 'control-group'
                                                ]
                                            ])->textInput([
                                                'type' => 'number', 'min' => '0',
                                                'maxlength' => true, 'class' => 'span3', 'required' => true
                                            ])->label('Usia Ibu Hamil : ', ['class' => 'control-label']) ?>

                        <?= $form->field($model, 'usia_kandungan', [
                                                'template' => '
                                            {label}
                                            <div class="controls">
                                                    {input} Minggu
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
                                                    {input} Kg
                                                    {error}
                                            </div>
                                            ',
                                                'options' => [
                                                    'class' => 'control-group'
                                                ]
                                            ])->textInput([
                                                'type' => 'number', 'min' => '0',
                                                'maxlength' => true, 'class' => 'span3', 'required' => true
                                            ])->label('Pertambahan Berat Badan : ', ['class' => 'control-label']) ?>

                        <?= $form->field($model, 'hemoglobin', [
                                                'template' => '
                                            {label}
                                            <div class="controls">
                                                    {input} (gr %)
                                                    {error}
                                            </div>
                                            ',
                                                'options' => [
                                                    'class' => 'control-group'
                                                ]
                                            ])->textInput([
                                                'type' => 'number', 'min' => '0',
                                                'maxlength' => true, 'class' => 'span3', 'required' => true
                                            ])->label('Hemoglobin (HB) : ', ['class' => 'control-label']) ?>


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
</div>