<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = 'Laporan';
?>
<div class="container-fluid">
    <div class="row-fluid">

        <div class="span12">
            <?php if (Yii::$app->session->hasFlash("success")) : ?>
                <div class="alert alert-success" role="alert">
                    <?= Yii::$app->session->getFlash("success") ?>
                </div>
            <?php elseif (Yii::$app->session->hasFlash("danger")) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= Yii::$app->session->getFlash("danger") ?>
                </div>
            <?php endif; ?>
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>Data Laporan User</h5>
                </div>
                <div class="widget-content nopadding">

                    <?= GridView::widget([
                        'tableOptions' => ['class' => 'table table-bordered data-table', 'id' => false],
                        'summary' => false,
                        'emptyText' => false,
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No',
                                'contentOptions' => ['style' => 'text-align:center']
                            ],

                            // 'id_pasien',
                            'nama_pasien',
                            [
                                'label' => 'Jenis Kelamin',
                                'value' => function ($model) {
                                    return ($model->id_jk == 1) ? "Laki-laki" : "Perempuan";
                                }
                            ],
                            [
                                'label' => 'Umur',
                                'value' => function ($model) {
                                    return date('Y', time()) - date('Y', strtotime($model->tgl_lahir));
                                }
                            ],
                            'alamat',
                            'no_hp',
                            [
                                'label' => 'Tanggal diagnosa',
                                'value' => function ($model) {
                                    $tgl_diagnosis = $model->diagnoses[0]->tgl_diagnosis;
                                    return date('d-M-Y', strtotime($tgl_diagnosis));
                                }
                            ],
                            [
                                'label' => 'Penyakit yang diderita',
                                'value' => function ($model) {

                                    $gejalas = array_values(ArrayHelper::map($model->diagnoses[0]->diagnosisGejalas, 'id_gejala', 'id_gejala'));
                                    $hasil = $model->diagnoses[0]->diagnosis($gejalas)['hasil'];
                                    return $hasil['id_penyakit']->nama_penyakit;
                                }
                            ],

                            // 'username',
                            //'password',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Aksi',
                                'headerOptions' => ['style' => 'width:25%'],
                                'contentOptions' => ['style' => 'text-align:center'],
                                'buttons' => [

                                    'delete' => function ($url, $model, $key) {
                                        $id = $model->diagnoses[0]->id_diagnosis;
                                        return  Html::a('<i class="glyphicon glyphicon-trash"></i> Hapus', ['delete-diagnosa', 'id' => $id],  [
                                            'class' => 'btn btn-danger btn-sm',
                                            'data' => ['method' => 'post', 'confirm' => 'Apakah anda yakin?']
                                        ]);
                                    },
                                ],
                                // 'visibleButtons' => [
                                //     'view' => false,

                                // ]
                            ],
                        ],
                    ]); ?>

                </div>
            </div>


        </div>


    </div>
</div>