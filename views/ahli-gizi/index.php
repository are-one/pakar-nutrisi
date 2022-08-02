<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AhliGiziSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ahli Gizis';
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
                <div class="widget-content nopadding table-responsive">

                    <?= GridView::widget([
                        'tableOptions' => ['class' => 'table table-bordered data-table'],
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'summary' => false,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No'
                            ],

                            // 'id_ahli',
                            'username',
                            'password',
                            'email:email',
                            'nama',
                            //'alamat',
                            //'jenis_kelamin',
                            //'foto',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>


                </div>
                <?php Pjax::end(); ?>

            </div>


        </div>


    </div>
</div>