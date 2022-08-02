<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="container-fluid">
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

                    <!-- === INPUT NAMA PASIEN === -->
                    <?= $form->field($model, 'nama_pasien', [
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
                    ])->label($model->getAttributeLabel('nama_pasien') . ' : ', ['class' => 'control-label']) ?>

                    <!-- === INPUT TGL LAHIR === -->
                    <?= $form->field($model, 'tgl_lahir', [
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
                    ])->input('date')->label($model->getAttributeLabel('tgl_lahir') . ' : ', ['class' => 'control-label'])
                    ?>

                    <!-- === INPUT JENIS KELAMIN === -->
                    <?= $form->field($model, 'id_jk', [
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
                    ])->dropDownList(ArrayHelper::map($data_jk, 'id_jk', 'jenis_kelamin'), [
                        'prompt' => '- Pilih jenis kelamin -',
                        'class' => 'span5', 'required' => true
                    ])->label($model->getAttributeLabel('id_jk') . ' : ', ['class' => 'control-label']) ?>
                    <!-- === AKHIR INPUT JENIS KELAMIN === -->


                    <!-- === INPUT NO HP === -->
                    <?= $form->field($model, 'no_hp', [
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
                    ])->label($model->getAttributeLabel('no_hp') . ' : ', ['class' => 'control-label']) ?>


                    <!-- === INPUT ALAMAT === -->
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
                        ],
                    ])->textarea([
                        'rows' => 6,
                        'class' => 'span10', 'required' => true
                    ])->label($model->getAttributeLabel('alamat') . ' : ', [
                        'class' => 'control-label'
                    ]);
                    ?>
                    <!-- === AKHIR INPUT ALAMAT PASIEN === -->

                    <!-- === INPUT USERNAME === -->
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
                        'maxlength' => true,
                        'class' => 'span5', 'required' => true
                    ])->label($model->getAttributeLabel('username') . ' : ', ['class' => 'control-label']) ?>
                    <!-- === AKHIR INPUT USERNAME === -->

                    <!-- ================================================================================================== -->
                    <?php if ($model->isNewRecord) : ?>
                        <!-- === INPUT PASSWORD === -->
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
                            ]
                        ])->passwordInput([
                            'maxlength' => true,
                            'class' => 'span5', 'required' => true
                        ])->label($model->getAttributeLabel('password') . ' : ', ['class' => 'control-label']) ?>
                        <!-- === AKHIR INPUT PASSWORD === -->

                        <!-- === INPUT ULANGI PASSWORD === -->
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
                            ]
                        ])->passwordInput([
                            'maxlength' => true,
                            'class' => 'span5', 'required' => true
                        ])->label($model->getAttributeLabel('ulangi_password') . ' : ', ['class' => 'control-label']) ?>
                        <!-- === AKHIR INPUT ULANGI PASSWORD === -->
                    <?php else : ?>
                        <!-- ================================================================================================== -->

                        <!-- === INPUT PASSWORD === -->
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
                            'maxlength' => true,
                            'class' => 'span5',
                        ])->label($model->getAttributeLabel('password_baru') . ' : ', ['class' => 'control-label']) ?>
                        <!-- === AKHIR INPUT PASSWORD === -->

                        <!-- === INPUT ULANGI PASSWORD === -->
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
                            'maxlength' => true,
                            'class' => 'span5',
                        ])->label($model->getAttributeLabel('ulangi_password_baru') . ' : ', ['class' => 'control-label']) ?>
                        <!-- === AKHIR INPUT ULANGI PASSWORD === -->
                    <?php endif; ?>
                    <!-- ================================================================================================== -->

                    <!-- === AWAL BUTTON SUBMIT SIMPAN PENYAKIT === -->
                    <div class="form-actions">
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                        <?= Html::resetButton('Reset', ['class' => 'btn btn-info']) ?>
                    </div>
                    <!-- === AKHIR BUTTON SUBMIT SIMPAN PENYAKIT === -->

                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>