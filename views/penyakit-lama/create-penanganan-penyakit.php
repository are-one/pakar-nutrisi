<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aturan */

$this->title = 'Tambah Data Penanganan';

?>
<div class="container-fluid">

    <?= $this->render('_form-create-penanganan-penyakit', [
        'id_penyakit' => $id_penyakit,
        'modelPenangananPenyakits' => $modelPenangananPenyakits,
        'listPenanganan' => $listPenanganan,
    ]) ?>

</div>