<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengobatan */

$this->title = $model->id_pengobatan;
$this->params['breadcrumbs'][] = ['label' => 'Pengobatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pengobatan-view">
    <div class="container-fluid">

        <div class="row-fluid">

            <div class="col-md-6">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id_pengobatan], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id_pengobatan], [
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
                                'attribute' => 'id_pengobatan',
                                'label' => 'ID Pengobatan',
                            ],
                            'pengobatan',
                        ],
                    ]) ?>

            </div>

        </div>

    </div>
</div>