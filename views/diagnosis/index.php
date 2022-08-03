<?php

use app\models\Diagnosis;
use app\models\Penyakit;
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
                                                    {input} Tahun
                                                    {error}
                                                    </div> 
                                            ',
                                                'options' => [
                                                    'class' => 'control-group'
                                                ]
                                            ])->textInput([
                                                'type' => 'number', 'min' => '10',
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
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                            <?= Html::resetButton('Reset', ['class' => 'btn btn-warning']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>

                </div>

            </div>
        </div>

        <!-- INFORMASI -->

        <div class="row-fluid">
            <div class="span12">

                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5><?= Html::encode('Hasil Diagnosis') ?> </h5>
                    </div>
                    <div class="widget-content">

                        <div class="span12">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th colspan="3">
                                        <h6>Data Penyakit dan Pengobatannya</h6>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="35%">Penyakit</th>
                                    <th colspan="2">Pengobatan</th>
                                </tr>

                                <?php 
                                        $penyakit = Penyakit::find()->all();

                                        if($penyakit){
                                            $no = 1;
                                            foreach ($penyakit as $data) {
                                        ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $data->nama_penyakit ?></td>
                                    <td>
                                        <?php 
                                                $dataPengobatan = $data->penyakitHasPengobatans ?? null;
                                                if($dataPengobatan){
                                            ?>
                                        <ol>

                                            <?php
                                                    foreach ($dataPengobatan as $value) {
                                                ?>
                                            <li><?= $value->pengobatan->pengobatan ?></li>
                                            <?php
                                                    }
                                                ?>
                                        </ol>

                                        <?php
                                            }else{
                                            ?>
                                        <i>Tidak ada data pengobatan</i>
                                        <?php
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <?php
                                        $no++;
                                        } 
                                    }else{
                                    ?>
                                <tr>
                                    <td colspan="2"><i>Tidak ada data penyakit yang terdiagnosa</i></td>
                                </tr>
                                <?php
                                    }
                                    ?>
                            </table>

                        </div>
                        <div class="row-fluid">
                            <div class="span5">

                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th colspan="2">Kondisi</th>
                                    </tr>
                                    <tr>
                                        <td width="40%">Usia Ibu Hamil</td>
                                        <td><?= $model->usia_ibu_hamil ?> Tahun</td>
                                    </tr>
                                    <tr>
                                        <td width="40%">Usia Kandungan</td>
                                        <td><?= $model->usia_kandungan ?> Minggu</td>
                                    </tr>
                                    <tr>
                                        <td width="40%">Pertambahan Berat Badan</td>
                                        <td><?= $model->pertambahan_bb ?> Kg</td>
                                    </tr>
                                    <tr>
                                        <td width="40%">Hemoglobin</td>
                                        <td><?= $model->hemoglobin ?> gr %</td>
                                    </tr>
                                </table>



                            </div>

                            <div class="span7">

                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th colspan="4">
                                            <h6>Data Hasil Diagnosa</h6>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="40%">Penyakit</th>
                                        <th width="20%">Nilai</th>
                                        <th colspan="2">Waktu Diagnosa</th>
                                    </tr>

                                    <?php 
                                    $penyakitPasien = Diagnosis::find()->where(['pasien_id' => Yii::$app->pasien->identity->id])->orderBy(['created_at' => SORT_DESC])->all();
                                    if($penyakitPasien){
                                        $no = 1;
                                        foreach ($penyakitPasien as $data) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $data->penyakit->nama_penyakit ?></td>
                                        <td><?= round($data->hasil_diagnosis, 2) ?></td>
                                        <td><?= $data->created_at ?></td>
                                    </tr>
                                    <?php 
                                    $no++;
                                        }
                                    }else{
                                    ?>
                                    <tr>
                                        <td colspan="3"><i>Tidak ada data penyakit yang terdiagnosa</i></td>
                                    </tr>
                                    <?php
                                            }
                                            ?>
                                </table>

                            </div>
                        </div>



                    </div>



                </div>

            </div>

        </div>
    </div>

</div>