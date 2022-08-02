<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AhliGizi */

$this->title = 'Ubah Profil';
$this->params['breadcrumbs'][] = ['label' => 'Ubah Profil', 'url' => ['ubah-profil']];
// $this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id_ahli]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ahli-gizi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>