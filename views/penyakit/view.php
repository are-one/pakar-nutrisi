<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Penyakit */

$this->title = "Penyakit : ".$model->id_penyakit;
$this->params['breadcrumbs'][] = ['label' => 'Penyakits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="penyakit-view">
    <div class="container-fluid">

        <div class="row-fluid">

            <div class="col-md-6">
                <h3><?= Html::encode($this->title) ?></h3>

                <p>
                    <?= Html::a('List Penyakit', ['index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Update', ['update', 'id' => $model->id_penyakit], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id_penyakit], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'id_penyakit',
                            'label' => 'ID Penyakit',
                            'captionOptions' => ['width' => '30%'],
                        ],
                        // [
                        //     'attribute' => 'id_aturan',
                        //     'contentOptions' => ['class' => 'col-md-8'],
                        //     'visible' => false,
                        // ],
                        'nama_penyakit',
                    ],
                ]) ?>

            </div>

            <div class="col-md-6">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderPenyakitHasPengobatan,

                    'layout' => '
                        <div style="margin-bottom:9px">
                            <h4>Pengobatan</h4>' .
                        Html::a('Tambah Pengobatan', ['penyakit/create-pengobatan-penyakit', 'id' => $model->id_penyakit], ['class' => 'btn btn-primary'])
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
                        'pengobatan.pengobatan',

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
                                            'delete-penyakit-pengobatan',
                                            'penyakit_id' => $model->penyakit_id,
                                            'pengobatan_id' => $model->pengobatan_id,
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