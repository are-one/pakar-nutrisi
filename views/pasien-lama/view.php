<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */

$this->title = $model->nama_pasien;
$this->params['breadcrumbs'][] = ['label' => 'Pasien', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
?>
<div class="pasien-view">
    <div class="container-fluid">

        <div class="row-fluid">

            <div class="col-md-6">
                <h4><?= Html::encode($this->title) ?></h4>

                <p>
                    <?= Html::a('Edit', ['update', 'id' => $model->id_pasien], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Hapus Pasien', ['delete', 'id' => $model->id_pasien], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('List Data Pasien', ['/pasien/index'], ['class' => 'btn btn-warning btn-sm']) ?>

                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'id_pasien',
                            'captionOptions' => ['class' => 'col-md-4'],
                            'contentOptions' => ['class' => 'col-md-8'],
                            'visible' => false,
                        ],
                        [
                            'attribute' => 'nama_pasien',
                            'captionOptions' => ['width' => '30%'],
                        ],
                        'tgl_lahir',
                        'alamat',
                        'no_hp',
                        'username',
                        'password',
                        [
                            'label' => 'Jenis Kelamin',
                            'value' => function ($model) {
                                return ($model->jk->jenis_kelamin == "L") ? "Laki-Laki (L)" : "Perempuan (P)";
                            }
                        ],
                    ],
                ]) ?>


            </div>



        </div>

    </div>
</div>