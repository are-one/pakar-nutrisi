<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Diagnosis */

$this->title = $model->pasien->nama;
$this->params['breadcrumbs'][] = ['label' => 'Diagnoses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="diagnosis-view">
    <div class="container-fluid">

        <div class="row-fluid">

            <div class="span12">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Kembali', ['hasil'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id_diagnosis], [
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
                            'attribute' => 'kondisi',
                            'value' => function($model)
                            {
                                return $model->penyakit->nama_penyakit;
                            }
                        ],
                        [
                            'attribute' => 'hasil_diagnosis',
                            'value' => function($model)
                            {
                                return round($model->hasil_diagnosis, 2);
                            }
                        ],
                        'created_at',
                    ],
                ]) ?>

            </div>

        </div>
    </div>
</div>