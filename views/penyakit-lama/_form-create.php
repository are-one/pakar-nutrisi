<?php

use app\models\Penanganan;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use app\models\Penyebab;

/* @var $this yii\web\View */
/* @var $model app\models\Penyakit */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('
$(".dynamicform_wrapper_penyebab").on("afterInsert", function(e, item) {
    $(".dynamicform_wrapper_penyebab .title").each(function(index) {
        $(this).html("Penyebab : " + (index + 1))
        
    });
});

$(".dynamicform_wrapper_penyebab").on("afterDelete", function(e) {

    $(".dynamicform_wrapper_penyebab .title").each(function(index) {

        $(this).html("Penyebab : " + (index + 1))
    });
});


// =========================== PENANGANAN ===============================
$(".dynamicform_wrapper_penanganan").on("afterInsert", function(e, item) {
    $(".dynamicform_wrapper_penanganan .title").each(function(index) {
        $(this).html("Penanganan : " + (index + 1))
        
    });
});

$(".dynamicform_wrapper_penanganan").on("afterDelete", function(e) {

    $(".dynamicform_wrapper_penanganan .title").each(function(index) {

        $(this).html("Penanganan : " + (index + 1))
    });
});
', View::POS_END);
?>


<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?= Html::a('Kembali', ['/penyakit/index'], ['class' => 'btn btn-warning btn-sm']) ?>

            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5><?= Html::encode($this->title) ?> </h5>
                </div>

                <div class="widget-content nopadding">

                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal', 'id' => 'penyakit-form'],
                        'errorCssClass' => 'error',
                    ]); ?>

                    <!-- === INPUT ID PENYAKIT === -->
                    <?= $form->field($model, 'id_penyakit', [
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
                    ])->textInput([
                        'maxlength' => true,
                        'class' => 'span5', 'required' => true
                    ])->label($model->getAttributeLabel('id_penyakit') . ' : ', ['class' => 'control-label']) ?>



                    <!-- === INPUT NAMA PENYAKIT === -->
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

                    <!-- === INPUT DESKRIPSI PENYAKIT === -->
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
                        ],
                    ])->textarea([
                        'rows' => 6,
                        'class' => 'span10', 'required' => true
                    ])->label($model->getAttributeLabel('deskripsi_penyakit') . ' : ', [
                        'class' => 'control-label'
                    ]);
                    ?>
                    <!-- === AKHIR INPUT DESKRIPSI PENYAKIT === -->


                    <!-- === AWAL BUTTON SUBMIT SIMPAN PENYAKIT === -->
                    <div class="form-actions">
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                        <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
                    </div>
                    <!-- === AKHIR BUTTON SUBMIT SIMPAN PENYAKIT === -->


                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5> Data Penyebab dan Penanganan </h5>
                        </div>

                        <div class="widget-content nopadding">
                            <!-- =============================================================================================================== -->
                            <!-- ========== AWAL FORM PENYEBAB ================================================================================= -->
                            <!-- =============================================================================================================== -->
                            <?php DynamicFormWidget::begin([

                                'widgetContainer' => 'dynamicform_wrapper_penyebab', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]

                                'widgetBody' => '.container-items', // required: css class selector

                                'widgetItem' => '.item', // required: css class

                                'limit' => 10, // the maximum times, an element can be cloned (default 999)

                                'min' => 1, // 0 or 1 (default 1)

                                'insertButton' => '.add-item', // css class

                                'deleteButton' => '.remove-item', // css class

                                'model' => $modelPenyebabPenyakits[0],

                                'formId' => 'penyakit-form', //harus sama dengan id form

                                'formFields' => [

                                    'id_penyebab',
                                    'id_penyakit',

                                ],

                            ]); ?>

                            <div class="container-fluid">

                                <div class="widget-box">
                                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                        <h5>Penyebab </h5>
                                        <div class="pull-right">
                                            <button type="button" class="add-item btn btn-primary btn-xs"><i class="icon icon-plus"></i> Tambah Penyebab</button>
                                        </div>

                                    </div>

                                    <div class="widget-content nopadding container-items">
                                        <!-- widgetContainer -->
                                        <?php
                                        foreach ($modelPenyebabPenyakits as $index => $modelPenyebabPenyakit) :

                                        ?>
                                            <div class="item container-fluid">

                                                <div class="row-fluid">
                                                    <div class="span12">

                                                        <div class="widget-box span">
                                                            <!-- widgetBody -->

                                                            <div class="widget-title">
                                                                <h5 class="title">Penyebab: <?= ($index + 1) ?> </h5>
                                                                <div class="pull-right">
                                                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="icon icon-minus"></i></button>
                                                                </div>

                                                            </div>
                                                            <div class="widget-content ">

                                                                <?php

                                                                // necessary for update action.

                                                                if (!$modelPenyebabPenyakit->isNewRecord) {

                                                                    echo Html::activeHiddenInput($modelPenyebabPenyakit, "[{$index}]id");
                                                                }

                                                                ?>


                                                                <?= $form->field($modelPenyebabPenyakit, "[{$index}]id_penyebab", [
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
                                                                ])->dropDownList(ArrayHelper::map(Penyebab::find()->orderBy(['id_penyebab' => SORT_ASC])->all(), 'id_penyebab', 'penyebab'), [
                                                                    'class' => 'span10',
                                                                    'prompt' => [
                                                                        'text' => '- Pilih penyebab -',
                                                                        'options' => ['value' => 0]
                                                                    ]


                                                                ])->label($modelPenyebabPenyakit->getAttributeLabel('id_penyebab') . ' : ', [
                                                                    'class' => 'control-label'
                                                                ]) ?>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        <?php endforeach; ?>


                                    </div>


                                </div>
                            </div>
                            <?php DynamicFormWidget::end(); ?>
                            <!-- =============================================================================================================== -->
                            <!-- ========== AKHIR FORM PENYEBAB =============================================================================== -->
                            <!-- =============================================================================================================== -->

                            <!-- =============================================================================================================== -->
                            <!-- ========== AWAL FORM PENANGANAN =============================================================================== -->
                            <!-- =============================================================================================================== -->
                            <?php DynamicFormWidget::begin([

                                'widgetContainer' => 'dynamicform_wrapper_penanganan', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]

                                'widgetBody' => '.container-items-penanganan', // required: css class selector

                                'widgetItem' => '.item-penanganan', // required: css class

                                'limit' => 10, // the maximum times, an element can be cloned (default 999)

                                'min' => 1, // 0 or 1 (default 1)

                                'insertButton' => '.add-item', // css class

                                'deleteButton' => '.remove-item', // css class

                                'model' => $modelPenangananPenyakits[0],

                                'formId' => 'penyakit-form', //harus sama dengan id form

                                'formFields' => [

                                    'id_penanganan',
                                    'id_penyakit'

                                ],

                            ]); ?>

                            <div class="container-fluid">

                                <div class="widget-box">
                                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                        <h5>Penanganan </h5>
                                        <div class="pull-right">
                                            <button type="button" class="add-item btn btn-primary btn-xs"><i class="icon icon-plus"></i> Tambah Penanganan</button>
                                        </div>

                                    </div>

                                    <div class="widget-content nopadding container-items-penanganan">
                                        <!-- widgetContainer -->
                                        <?php
                                        foreach ($modelPenangananPenyakits as $indexPenanganan => $modelPenangananPenyakit) :

                                        ?>
                                            <div class="item-penanganan container-fluid">

                                                <div class="row-fluid">
                                                    <div class="span12">

                                                        <div class="widget-box span">
                                                            <!-- widgetBody -->

                                                            <div class="widget-title">
                                                                <h5 class="title">Penanganan: <?= ($indexPenanganan + 1) ?> </h5>
                                                                <div class="pull-right">
                                                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="icon icon-minus"></i></button>
                                                                </div>

                                                            </div>
                                                            <div class="widget-content ">

                                                                <?php

                                                                // necessary for update action.

                                                                if (!$modelPenangananPenyakit->isNewRecord) {

                                                                    echo Html::activeHiddenInput($modelPenangananPenyakit, "[{$indexPenanganan}]id");
                                                                }

                                                                ?>


                                                                <?= $form->field($modelPenangananPenyakit, "[{$indexPenanganan}]id_penanganan", [
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
                                                                ])->dropDownList(ArrayHelper::map(Penanganan::find()->orderBy(['id_penanganan' => SORT_ASC])->all(), 'id_penanganan', 'penanganan'), [
                                                                    'class' => 'span10',
                                                                    'prompt' => [
                                                                        'text' => '- Pilih penanganan -',
                                                                        'options' => ['value' => 0]
                                                                    ]


                                                                ])->label($modelPenangananPenyakit->getAttributeLabel('id_penanganan') . ' : ', [
                                                                    'class' => 'control-label'
                                                                ]) ?>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        <?php endforeach; ?>


                                    </div>


                                </div>
                            </div>
                            <?php DynamicFormWidget::end(); ?>

                            <!-- =============================================================================================================== -->
                            <!-- ========== AKHIR FORM PENANGANAN ============================================================================== -->
                            <!-- =============================================================================================================== -->
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>