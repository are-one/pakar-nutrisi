<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DiagnosisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diagnoses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diagnosis-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Diagnosis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_diagnosis',
            'pengobatan_id_pengobatan',
            'penyakit_id_penyakit',
            'hasil_diagnosis:ntext',
            'kondisi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
