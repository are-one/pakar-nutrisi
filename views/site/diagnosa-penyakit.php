<?php

if (count($gejala_pilihan) > 0) {
    // print_r($gejala_pilihan);
    echo $this->render('hasil', ['gejala_pilihan' => $gejala_pilihan, 'gejala' => $gejala]);
} else {
    echo $this->render('form-diagnosa', [
        'data_gejala' => $data_gejala,
    ]);
}
