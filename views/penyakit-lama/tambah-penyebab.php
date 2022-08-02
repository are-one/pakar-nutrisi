<?php

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
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    $(".dynamicform_wrapper .title").each(function(index) {
        $(this).html("Penyebab : " + (index + 1))
        
    });
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {

    $(".dynamicform_wrapper .title").each(function(index) {

        $(this).html("Penyebab : " + (index + 1))
    });
});', View::POS_END);
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
                        'options' => ['class' => 'form-horizontal', 'id' => 'penyebab-form'],
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


                    <?php DynamicFormWidget::begin([

                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]

                        'widgetBody' => '.container-items', // required: css class selector

                        'widgetItem' => '.item', // required: css class

                        'limit' => 10, // the maximum times, an element can be cloned (default 999)

                        'min' => 1, // 0 or 1 (default 1)

                        'insertButton' => '.add-item', // css class

                        'deleteButton' => '.remove-item', // css class

                        'model' => $modelPenyebabPenyakits[0],

                        'formId' => 'penyebab-form', //harus sama dengan id form

                        'formFields' => [

                            'id_penyebab',
                            'penyebab'

                        ],

                    ]); ?>

                    <div class="container-fluid">

                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                <h5>penyebab </h5>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Jabatan</button>
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
                                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                                {input}{hint}{error}
                                            </div>
                                            '
                                                        ])->dropDownList(ArrayHelper::map(Penyebab::find()->orderBy(['id_penyebab' => SORT_ASC])->all(), 'id_penyebab', 'penyebab'), [
                                                            'prompt' => '-- Penyebab --',

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


                    <div class="form-actions">
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                        <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>