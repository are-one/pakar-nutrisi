<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Aturan */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        $(".dynamicform_wrapper .title").each(function(index) {
        $(this).html("Penanganan : " + (index + 1))
        
        });
    });
    
    $(".dynamicform_wrapper").on("afterDelete", function(e) {
    
        $(".dynamicform_wrapper .title").each(function(index) {
        
        $(this).html("Penanganan : " + (index + 1))
        });
    });
                  ', View::POS_END);
?>

<div class="container-fluid">
    <div class="row-fluid">
        <?= Html::a('Kembali', ['/penyakit/view', 'id' => $id_penyakit], ['class' => 'btn btn-warning btn-sm']) ?>


        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal', 'id' => 'penanganan-penyakit-form'],
            'errorCssClass' => 'error',
        ]); ?>

        <!-- =============================================================================================================== -->
        <!-- ========== AWAL FORM GEJALA ================================================================================= -->
        <!-- =============================================================================================================== -->
        <?php DynamicFormWidget::begin([

            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]

            'widgetBody' => '.container-items', // required: css class selector

            'widgetItem' => '.item', // required: css class

            'limit' => 10, // the maximum times, an element can be cloned (default 999)

            'min' => 1, // 0 or 1 (default 1)

            'insertButton' => '.add-item', // css class

            'deleteButton' => '.remove-item', // css class

            'model' => $modelPenyakitHasPengobatan[0],

            'formId' => 'penanganan-penyakit-form', //harus sama dengan id form

            'formFields' => [

                'penyakit_id',
                'pengobatan_di',

            ],

        ]); ?>



        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5><?= Html::encode($this->title) ?> </h5>
                <div class="pull-right">
                    <button type="button" class="add-item btn btn-primary btn-xs"><i class="icon icon-plus"></i> Tambah
                        Pengobatan</button>
                </div>

            </div>

            <div class="widget-content nopadding">
                <!-- widgetContainer -->
                <div class="container-items">

                    <?php
                    foreach ($modelPenyakitHasPengobatan as $index => $penyakitHasPengobatan) :

                    ?>
                    <div class="item container-fluid">



                        <div class="widget-box span">
                            <!-- widgetBody -->

                            <div class="widget-title">
                                <h5 class="title">Penanganan: <?= ($index + 1) ?> </h5>
                                <div class="pull-right">
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                            class="icon icon-minus"></i></button>
                                </div>

                            </div>
                            <div class="widget-content ">

                                <?php

                                    // necessary for update action.

                                    // if (!$penyakitHasPengobatan->isNewRecord) {
                                    // echo Html::activeHiddenInput($penyakitHasPengobatan, "[{$index}]id_penyakit", ['value' => $id_penyakit]);
                                    // }

                                    ?>

                                <?= $form->field($penyakitHasPengobatan, "[{$index}]pengobatan_id", [
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
                                    ])->dropDownList(ArrayHelper::map($listPengobatan, 'id_pengobatan', 'pengobatan'), [
                                        'class' => 'span10',
                                        'prompt' => [
                                            'text' => '- Pilih Pengobatan -',
                                            'options' => ['value' => 0]
                                        ]


                                    ])->label($penyakitHasPengobatan->getAttributeLabel('pengobatan_id') . ' : ', [
                                        'class' => 'control-label'
                                    ]) ?>
                            </div>

                        </div>




                    </div>
                    <?php endforeach; ?>

                </div>

                <!-- === AWAL BUTTON SUBMIT SIMPAN PENYAKIT === -->
                <div class="form-actions">
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                    <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
                </div>
                <!-- === AKHIR BUTTON SUBMIT SIMPAN PENYAKIT === -->
            </div>
        </div>

        <?php DynamicFormWidget::end(); ?>
        <!-- =============================================================================================================== -->
        <!-- ========== AKHIR FORM GEJALA =============================================================================== -->
        <!-- =============================================================================================================== -->




        <?php ActiveForm::end(); ?>

    </div>

</div>