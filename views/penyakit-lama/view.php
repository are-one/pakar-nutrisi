<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Penyakit */

$this->title = "Penyakit : " . $model->id_penyakit;
$this->params['breadcrumbs'][] = ['label' => 'Penyakit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
?>
<div class="penyakit-view">
    <div class="container-fluid">

        <div class="row-fluid">

            <div class="col-md-6">
                <h4><?= Html::encode($this->title) ?></h4>

                <p>
                    <?= Html::a('Edit', ['update', 'id' => $model->id_penyakit], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Hapus Penyakit', ['delete', 'id' => $model->id_penyakit], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('List Data Penyakit', ['/penyakit/index'], ['class' => 'btn btn-warning btn-sm']) ?>

                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'id_aturan',
                            'captionOptions' => ['class' => 'col-md-4'],
                            'contentOptions' => ['class' => 'col-md-8'],
                            'visible' => false,
                        ],
                        [
                            'attribute' => 'nama_penyakit',
                            'captionOptions' => ['width' => '30%'],
                        ],
                        'deskripsi_penyakit:ntext',
                    ],
                ]) ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProviderPenanganan,

                    'layout' => '
                        <div style="margin-bottom:9px">
                            <h4>Penanganan</h4>' .
                        Html::a('Tambah Penanganan', ['penyakit/create-penanganan-penyakit', 'id' => $model->id_penyakit], ['class' => 'btn btn-primary'])
                        . '{summary}
                        </div>
                        {items}',

                    'summary' => '<span class="pull-right">Total <b>{totalCount}</b> Data</span>',

                    'columns' => [
                        // Kolom Nomor ===============================================
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No',
                            'contentOptions' => ['style' => 'text-align:center; width:20%']
                        ],

                        // Kolom data ================================================
                        'penanganan.penanganan',

                        // Kolom aksi ==================================================
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Aksi',
                            'headerOptions' => ['style' => 'width:25%'],
                            'contentOptions' => ['style' => 'text-align:center'],
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return  Html::a(
                                        '<i class="glyphicon glyphicon-trash"></i> Hapus',
                                        [
                                            'delete-penanganan-penyakit',
                                            'id_penyakit' => $model->id_penyakit,
                                            'id_penanganan' => $model->id_penanganan,
                                        ],
                                        [
                                            'class' => 'btn btn-danger btn-sm',
                                            'data' => ['method' => 'post', 'confirm' => 'Apakah anda yakin?']
                                        ]
                                    );
                                },
                            ],
                            'visibleButtons' => [
                                'view' => false,
                                'update' => false,
                            ]
                        ],
                    ],
                ]) ?>
            </div>

            <!-- TABEL GEJALA -->
            <div class="col-md-6">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderPenyebab,

                    'layout' => '
                        <div style="margin-bottom:9px">
                            <h4>Penyebab</h4>' .
                        Html::a('Tambah Penyebab', ['penyakit/create-penyebab-penyakit', 'id' => $model->id_penyakit], ['class' => 'btn btn-primary'])
                        . '{summary}
                        </div>
                        {items}',

                    'summary' => '<span class="pull-right">Total <b>{totalCount}</b> Data</span>',

                    'columns' => [
                        // Kolom Nomor ===============================================
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No',
                            'contentOptions' => ['style' => 'text-align:center; width:20%']
                        ],

                        // Kolom data ================================================
                        'penyebab.penyebab',

                        // Kolom aksi ==================================================
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Aksi',
                            'headerOptions' => ['style' => 'width:25%'],
                            'contentOptions' => ['style' => 'text-align:center'],
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return  Html::a(
                                        '<i class="glyphicon glyphicon-trash"></i> Hapus',
                                        [
                                            'delete-penyebab-penyakit',
                                            'id_penyakit' => $model->id_penyakit,
                                            'id_penyebab' => $model->id_penyebab,
                                        ],
                                        [
                                            'class' => 'btn btn-danger btn-sm',
                                            'data' => ['method' => 'post', 'confirm' => 'Apakah anda yakin?']
                                        ]
                                    );
                                },
                            ],
                            'visibleButtons' => [
                                'view' => false,
                                'update' => false,
                            ]
                        ],
                    ],
                ]) ?>
            </div>

        </div>

    </div>
</div>