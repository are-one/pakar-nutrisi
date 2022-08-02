<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengobatan */

$this->title = 'Tambah Pengobatan';
$this->params['breadcrumbs'][] = ['label' => 'Pengobatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengobatan-create">

    <?= $this->render('_form-create', [
        'model' => $model,
    ]) ?>

</div>