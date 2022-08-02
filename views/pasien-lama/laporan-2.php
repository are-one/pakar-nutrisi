<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = 'Laporan';
?>
<div class="container-fluid">
    <div class="row-fluid">


        <div class="span12">
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
                            'id_jk',
                            [
                                'label' => 'tgl_lahir',
                                'value' => function ($model) {
                                    return date('Y', time()) - date('Y', strtotime($model->tgl_lahir));
                                }
                            ],
                            'alamat',
                            'no_hp',
                            // 'username',
                            //'password',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Aksi',
                                'headerOptions' => ['style' => 'width:25%'],
                                'contentOptions' => ['style' => 'text-align:center'],
                                'buttons' => [

                                    'view' => function ($url, $model, $key) {
                                        return  Html::a('<i class="glyphicon glyphicon-eye-open"></i> Detail', $url, ['class' => 'btn btn-info btn-sm']);
                                    },

                                    'update' => function ($url, $model, $key) {
                                        return  Html::a('<i class="glyphicon glyphicon-pencil"></i> Edit', $url, ['class' => 'btn btn-warning btn-sm']);
                                    },

                                    'delete' => function ($url, $model, $key) {
                                        return  Html::a('<i class="glyphicon glyphicon-trash"></i> Hapus', $url,  [
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