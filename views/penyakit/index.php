<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PenyakitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penyakit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row-fluid">


        <div class="span12">
            <?= Html::a('Tambah ' . Html::encode($this->title), ['create'], ['class' => 'btn btn-success']) ?>
            <div class="widget-box">
                <?php Pjax::begin(); ?>

                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5> Data <?= Html::encode($this->title) ?></h5>
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
                                'headerOptions' => ['style' => 'width:5%'],
                                'contentOptions' => ['style' => 'text-align:center'],
                            ],

                            [
                                'attribute' => 'id_penyakit',
                                'label' => 'ID Penyakit',
                                'headerOptions' => ['style' => 'width:15%'],
                                'contentOptions' => ['style' => 'text-align:center'],
                            ],
                            'nama_penyakit',

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
                <?php Pjax::end(); ?>

            </div>


        </div>


    </div>
</div>