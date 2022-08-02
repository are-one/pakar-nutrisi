<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aturan */

$this->title = 'Tambah Data Penyebab';

?>
<div class="container-fluid">

    <?= $this->render('_form-create-penyebab-penyakit', [
        'id_penyakit' => $id_penyakit,
        'modelPenyebabPenyakits' => $modelPenyebabPenyakits,
        'listPenyebab' => $listPenyebab,
    ]) ?>

</div>