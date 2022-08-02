<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AhliGizi */

$this->title = 'Create Ahli Gizi';
$this->params['breadcrumbs'][] = ['label' => 'Ahli Gizis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ahli-gizi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>