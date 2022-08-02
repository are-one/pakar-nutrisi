<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pasien-view">
    <div class="container-fluid">

        <div class="row-fluid">

            <div class="col-md-6">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id_pasien], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id_pasien], [
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
            // 'id_pasien',
            'nama',
            'alamat',
            'email:email',
            'username',
            'password',
            'umur',
            'usia_kandungan',
            'pertambahan_bb',
            'hb',
            'status',
            [
                'attribute' => 'ahli_gizi_id',
                'label' => 'Ahli Gizi',
                'value' => function($model)
                {
                    return $model->ahliGizi->nama;
                }
            ],
        ],
    ]) ?>

            </div>
        </div>

    </div>
</div>