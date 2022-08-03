<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aturan */

$this->title = 'Tambah Data Pengobatan';

?>
<div class="container-fluid">

    <?= $this->render('_form-create-pengobatan-penyakit', [
        'id_penyakit' => $id_penyakit,
        'modelPenyakitHasPengobatan' => $modelPenyakitHasPengobatan,
        'listPengobatan' => $listPengobatan,
    ]) ?>

</div>