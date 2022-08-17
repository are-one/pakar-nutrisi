<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

// use kartik\date\DatePicker;

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Daftar';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJS('
                  $(".invalid-feedback").on("DOMNodeInserted",function(){
                      currentInput = $(this).siblings(":input")
            
                    currentInput.addClass("is-invalid")
                    currentInput.removeClass("is-valid")
                      
                  });
                  
                  $(".invalid-feedback").on("DOMNodeRemoved",function(){
                    currentInput = $(this).siblings(":input")
                 
                    currentInput.removeClass("is-invalid")
                    currentInput.addClass("is-valid")
            
                });
                  
                  $(":input").change(function(){
                      nilai = $(this).val()
                      if(nilai != "" && $(this).siblings(".invalid-feedback").html() == ""){
                        $(this).addClass("is-valid")
                        $(this).removeClass("is-invalid")
                      }
                  })
                  
                  $(":input").change(function(){
                    nilai = $(this).val()
                    if(nilai != "" && $(this).siblings().child(".invalid-feedback").html() == ""){
                      $(this).addClass("is-valid")
                      $(this).removeClass("is-invalid")
                    }
                })
                  
               
                                   
                  
                  ', View::POS_END);
?>

<section id="departments" class="departments">

    <div class="container" style="min-height: 290px;" data-aos="fade-up">

        <div class="section-title">
            <div class="row">

                <div class="col-lg-10">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                    ]); ?>
                    <?php if(Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                    <?php elseif(Yii::$app->session->hasFlash('error')): ?>
                    <div class="alert alert-danger">
                        <?= Yii::$app->session->getFlash('error') ?>
                    </div>
                    <?php endif; ?>

                    <div class="form-row">

                        <?= $form->field($model, 'nama', [
                            'template' => '
                            {input}
                            {error}
                            <div class="validate"></div>
                            ',
                            'options' => ['class' => 'col-8 form-group'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ])->textInput([
                            'autofocus' => true,
                            'placeholder' => 'Nama Pasien',
                            'class' => 'form-control',
                            'data' => ['rule' => 'minlen:4', 'msg' => 'Please enter at least 4 chars']
                        ]) ?>


                        <?= $form->field($model, 'umur', [
                            'template' => '
                            {input}
                            {error}
                            <div class="validate"></div>
                            ',
                            'options' => ['class' => 'col form-group'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ])->textInput([
                            'autofocus' => true,
                            'placeholder' => 'Umur',
                            'class' => 'form-control',
                            'type' => 'number',
                            'data' => ['rule' => 'max:100', 'msg' => 'Please enter at least 4 chars']
                        ]) ?>
                    </div>



                    <div class="form-row">

                        <?php // $form->field($model, 'tgl_lahir', [
                        //     'template' => '
                        //     {input}
                        //     {error}
                        //     <div class="validate"></div>
                        //     ',
                        //     'options' => ['class' => 'col-6 form-group'],
                        //     'inputOptions' => ['placeholder' => 'Tanggal lahir'],
                        //     'errorOptions' => ['class' => 'invalid-feedback'],
                        // ])->widget(DatePicker::className(), [
                        //     'name' => 'dp_2',
                        //     'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        //     'value' => '23-Feb-1982',
                        //     'pluginOptions' => [
                        //         'autoclose' => true,
                        //         'format' => 'dd-M-yyyy'
                        //     ]
                        // ]); ?>

                        <?= $form->field($model, 'email', [
                            'template' => '
                            {input}
                            {error}
                            <div class="validate"></div>
                            ',
                            'options' => ['class' => 'col-12 form-group'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ])->textInput([
                            'autofocus' => true,
                            'placeholder' => 'Email',
                            'class' => 'form-control',
                            'data' => ['rule' => 'minlen:4', 'msg' => 'Please enter at least 4 chars']
                        ]) ?>


                    </div>

                    <!-- === INPUT ALAMAT === -->
                    <div class="form-row">

                        <?= $form->field($model, 'alamat', [
                            'template' => '
                            {input}
                            {error}
                            <div class="validate"></div>
                            ',
                            'options' => ['class' => 'col-12 form-group'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ])->textarea([
                            'rows' => 6,
                            'class' => 'form-control',
                            'placeholder' => 'Alamat'
                        ]);
                        ?>
                    </div>

                    <!-- === AKHIR INPUT ALAMAT === -->

                    <div class="form-row">

                        <?= $form->field($model, 'username', [
                            'template' => '
                                {input}
                                {error}
                                <div class="validate"></div>
                                ',
                            'options' => ['class' => 'col-4 form-group'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ])->textInput([
                            'autofocus' => true,
                            'placeholder' => 'Username',
                            'class' => 'form-control',
                            'data' => ['rule' => 'minlen:4', 'msg' => 'Please enter at least 4 chars']
                        ]) ?>

                        <?= $form->field($model, 'password', [
                            'template' => '
                            {input}
                            {error}
                            <div class="validate"></div>
                            ',
                            'options' => ['class' => 'col-4 form-group'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ])->passwordInput([
                            'placeholder' => 'Password',
                            'class' => 'form-control',
                            'data' => ['rule' => 'minlen:4', 'msg' => 'Please enter at least 8 chars of subject']
                        ]) ?>

                        <?= $form->field($model, 'ulangi_password', [
                            'template' => '
                            {input}
                            {error}
                            <div class="validate"></div>
                            ',
                            'options' => ['class' => 'col-4 form-group'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ])->passwordInput([
                            'placeholder' => 'Ulangi Password',
                            'class' => 'form-control',
                            'data' => ['rule' => 'minlen:4', 'msg' => 'Please enter at least 8 chars of subject']
                        ]) ?>


                    </div>




                    <div class="text-center">
                        <?= Html::submitButton('Daftar', ['class' => 'btn btn-primary', 'style' => 'background-color: #00cccc; width: 200px; height: 40px; border: none; border-radius: 20px; color: #ffffff ;']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

                <div class="col-lg-4">

                </div>

            </div>
        </div>

    </div>

</section>