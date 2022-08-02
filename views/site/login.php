<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJS('
// $(".invalid-feedback").ready(function(){
//     alert("skfdjks")
// })
//                   $(".invalid-feedback").on("DOMNodeInserted",function(){


//                       currentInput = $(this).siblings(":input")

//                     currentInput.addClass("is-invalid")
//                     currentInput.removeClass("is-valid")

//                   });

//                   $(".invalid-feedback").on("DOMNodeRemoved",function(){
//                     currentInput = $(this).siblings(":input")

//                     currentInput.removeClass("is-invalid")
//                     currentInput.addClass("is-valid")

//                 });      
//                   ', View::POS_END);
?>

<section id="departments" class="departments">

    <div class="container" style="min-height: 290px;" data-aos="fade-up">

        <div class="section-title">
            <div class="row">

                <div class="col-lg-6">

                    <!-- <div class="row">
                </div> -->

                </div>

                <div class="col-lg-4">

                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'enableClientScript' => false,
                        'errorSummaryCssClass' => '',
                        'encodeErrorSummary' => true,
                        'errorCssClass' => 'is-invalid'
                    ]); ?>


                    <?php if (strlen($form->errorSummary($model, [
                        'header' => '',
                        'class' => 'text-danger',
                        // 'tag' => 'div',
                    ])) > 62) {
                    ?>
                        <div class="alert alert-danger">
                            <?= $form->errorSummary($model, [
                                'header' => '<b>Peringatan</b>',
                                'class' => 'text-danger text-left'
                            ]) ?>
                        </div>
                    <?php
                    } ?>
                    <div class="form-row">

                        <?= $form->field($model, 'username', [
                            'template' => '
                            {input}
                            {error}
                            <div class="validate"></div>
                            ',
                            'options' => ['class' => 'col form-group'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ])->textInput([
                            'autofocus' => true,
                            'placeholder' => 'Username',
                            'class' => 'form-control',
                            'data' => ['rule' => 'minlen:4', 'msg' => 'Please enter at least 4 chars']
                        ]) ?>

                    </div>


                    <?= $form->field($model, 'password', [
                        'template' => '
                            {input}
                            {error}
                            <div class="validate"></div>
                            ',
                        'options' => ['class' => 'form-group'],
                        'errorOptions' => ['class' => 'invalid-feedback'],
                    ])->passwordInput([
                        'placeholder' => 'Password',
                        'class' => 'form-control',
                        'data' => ['rule' => 'minlen:4', 'msg' => 'Please enter at least 8 chars of subject']
                    ]) ?>



                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"form-group text-left\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ]) ?>

                    <div class="text-center">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'style' => 'background-color: #00cccc; width: 200px; height: 40px; border: none; border-radius: 20px; color: #ffffff ;', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>

    </div>
</section>