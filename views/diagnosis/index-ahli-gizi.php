<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DiagnosisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data hasil diagnosis pasien';
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
                    <?php Pjax::begin(); ?>

                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5> Data <?= Html::encode($this->title) ?></h5>
                    </div>
                    <div class="widget-content nopadding">

                        <p>
                            <?php // Html::a('Create Diagnosis', ['create'], ['class' => 'btn btn-success']) ?>
                        </p>

                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                        <?= GridView::widget([
                            'tableOptions' => ['class' => 'table table-bordered data-table', 'id' => false],
                            'summary' => false,
                            'emptyText' => false,
                            'dataProvider' => $dataProvider,
                            // 'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                // 'id_diagnosis',
                                [
                                    'attribute' => 'pasien_id',
                                    'attribute' => 'Nama Pasien',
                                    'value' => function($model)
                                    {
                                        return $model->pasien->nama;
                                    }
                                ],
                                [
                                    'attribute' => 'hasil_diagnosis',
                                    'value' => function($model)
                                    {
                                        return round($model->hasil_diagnosis, 2);
                                    }
                                ],
                                [
                                    'attribute' => 'kondisi',
                                    'value' => function($model)
                                    {
                                        return $model->penyakit->nama_penyakit;
                                    }
                                ],

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Aksi',
                                    'headerOptions' => ['style' => 'width:25%'],
                                    'contentOptions' => ['style' => 'text-align:center'],
                                    'buttons' => [

                                        'view' => function ($url, $model, $key) {
                                            return  Html::a('<i class="glyphicon glyphicon-eye-open"></i> Detail', $url, ['class' => 'btn btn-info btn-sm']);
                                        },


                                        'delete' => function ($url, $model, $key) {
                                            return  Html::a('<i class="glyphicon glyphicon-trash"></i> Hapus', $url,  [
                                                'class' => 'btn btn-danger btn-sm',
                                                'data' => ['method' => 'post', 'confirm' => 'Apakah anda yakin?']
                                            ]);
                                        },
                                    ],
                                    'visibleButtons' => [
                                        'update' => false,
                                    ]
                                ],
                            ],
                        ]); ?>


                    </div>
                    <?php Pjax::end(); ?>

                </div>


            </div>


        </div>
    </div>
</div>