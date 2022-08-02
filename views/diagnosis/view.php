<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Diagnosis */

$this->title = $model->id_diagnosis;
$this->params['breadcrumbs'][] = ['label' => 'Diagnoses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="diagnosis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_diagnosis' => $model->id_diagnosis, 'pengobatan_id_pengobatan' => $model->pengobatan_id_pengobatan, 'penyakit_id_penyakit' => $model->penyakit_id_penyakit], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_diagnosis' => $model->id_diagnosis, 'pengobatan_id_pengobatan' => $model->pengobatan_id_pengobatan, 'penyakit_id_penyakit' => $model->penyakit_id_penyakit], [
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
            'id_diagnosis',
            'pengobatan_id_pengobatan',
            'penyakit_id_penyakit',
            'hasil_diagnosis:ntext',
            'kondisi',
        ],
    ]) ?>

</div>
