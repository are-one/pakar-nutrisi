<?php

use yii\bootstrap\ActiveForm;
?>
<section id="appointment" class="appointment section-bg">
    <div class="container" data-aos="fade-up">

        <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show">

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>

                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>

        <div class="section-title">
            <h2>Formulir Diagnosa THT</h2>
            <p>Silahkan memilih gejala berdasarkan yang sedang dialami</p>
        </div>

        <?php
        $form = ActiveForm::begin([
            'options' => ['id' => 'penyakit-form'],
            // 'errorCssClass' => 'error',
        ]); ?> <table style="margin-left: auto;margin-right: auto;width:50%">
            <?php
            for ($i = 0; $i < count($data_gejala); $i++) {
            ?>
                <tr>
                    <?php if (isset($data_gejala[$i])) { ?>

                        <td width="5%"><input type="checkbox" name="gejala[]" id="gejala" value="<?= $data_gejala[$i]['id_gejala']; ?>"></td>
                        <td width="40%">
                            <?= $data_gejala[$i]['nama_gejala']; ?>
                        </td>

                    <?php
                    } else {
                        break;
                    }
                    ?>

                    <td width="10%"></td>
                    <?php
                    $i += 1;
                    if (isset($data_gejala[$i])) {
                    ?>

                        <td width="5%"><input type="checkbox" name="gejala[]" id="gejala" value="<?= $data_gejala[$i]['id_gejala']; ?>"></td>
                        <td width="40%">
                            <?= $data_gejala[$i]['nama_gejala']; ?>
                        </td>

                    <?php
                    } else {
                        break;
                    }
                    ?>
                </tr>

            <?php } ?>
        </table>
        <br>
        <div class="text-center"><button type="submit" style="background-color: #00cccc; width: 200px; height: 40px; border: none; border-radius: 20px; color: #ffffff ;">Proses</button></div>
        <?php ActiveForm::end(); ?>

    </div>
</section><!-- End Appointment Section -->