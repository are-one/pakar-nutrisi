<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Diagnosis */

$this->title = 'Update Diagnosis: ' . $model->id_diagnosis;
$this->params['breadcrumbs'][] = ['label' => 'Diagnoses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_diagnosis, 'url' => ['view', 'id' => $model->id_diagnosis]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="diagnosis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
