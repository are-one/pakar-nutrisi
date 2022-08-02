<?php

use yii2assets\printthis\PrintThis;

?>
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Hasil Diagnosa</h2>
            <p>Hasil Analisa Diagnosa Penyakit THT Dengan Metode Teorema Bayes</p>
            <center>
                <table style="margin-top: 20px;">
                    <tr>
                        <td rowspan="2" align="right">P(H|E) =</td>
                        <td>P(E|H) * P(H)
                            <hr style="margin: inherit; padding: inherit;">
                            <div class="text-center">P(E)</div>
                        </td>
                    </tr>
                </table>
            </center>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-lg-6" data-aos="fade-right">
                        <h4 class="text-center" style="background-color: #3fbbc0;color: #fff; padding: 8px; border-radius: 10px;">Gejala yang dialami</h4>
                        
                            <!-- <pre> -->
                            <?php

                            // $penyakit = $gejala_pilihan['hasil']['id_penyakit'];
                            // $daftar_gejala = $gejala_pilihan['hasil']['gejala'];
                            // $total = $gejala_pilihan['hasil']['total'];
                            //  echo "<pre>";
                            //  print_r($gejala_pilihan);
                            //  die;
                            foreach($gejala_pilihan['hasil'] as $daftar_gejala):
                                $total = $daftar_gejala['total']; 
                                $penyakit = $daftar_gejala['id_penyakit'];
                                ?>
                                <span class="mt-4 d-block"><b><?= $penyakit->id_penyakit." : ".$penyakit->nama_penyakit ?></b></span> 
                           <?php foreach ($daftar_gejala['gejala'] as $id_gejala => $probabilitas) :
                                // echo "<pre>";
                                $nilai = explode('/', $probabilitas);
                                // print_r($daftar_gejala);die;

                                
                               
                            ?>
                            
                                <table >
                                    <tr style="height: 70px;">
                                        <td align="right">
                                            P(<?= $penyakit->id_penyakit . "|" . $id_gejala ?>) &nbsp; = &nbsp;
                                        </td>

                                        <td>
                                            P(<?= $id_gejala . "|" . $penyakit->id_penyakit ?>) x P(<?= $penyakit->id_penyakit ?>)

                                            <hr style="margin: inherit; padding: inherit;">

                                            <div class="text-center">
                                                P(<?= $id_gejala ?>)
                                            </div>

                                        </td>

                                        <td>
                                            &nbsp; = &nbsp;<?= (count($nilai) > 1) ? round( $nilai[0] / $nilai[1],2) : round( $nilai[0],2)  ?>
                                        </td>
                                    </tr>
                                </table>
                            <br>
                            
                            <?php 
                            
                        endforeach;
                        echo "Total =". round( $total,2);
                    endforeach;
                        ?>
                        
                    </div>


                    <div id="PrintThis" class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
                        <h4 class="text-center" style="background-color: #3fbbc0;color: #fff; padding: 8px; border-radius: 10px;">Kesimpulan</h4>
                        <span>Tanggal diagnosa : <?= date('d-m-Y',strtotime(Yii::$app->pasien->identity->diagnoses[0]->tgl_diagnosis)) ?></span>
                        <?php
                        echo PrintThis::widget([
                            'htmlOptions' => [
                                'id' => 'PrintThis',
                                'btnClass' => 'btn btn-info float-right',
                                'btnId' => 'btnPrintThis',
                                'btnText' => 'Cetak',
                                'btnIcon' => 'icofont-printer'
                            ],
                            'options' => [
                                'debug' => false,
                                'importCSS' => true,
                                'importStyle' => false,
                                'loadCSS' => "path/to/my.css",
                                'pageTitle' => "Hasil Diagnosa",
                                'removeInline' => false,
                                'printDelay' => 333,
                                'header' => 'Hasil diagnosa',
                                'formValues' => true,
                            ]
                        ]);
                        ?>
                        <p style='color:#3fbbc0; font-size:17pt; font-weight:bold; margin-bottom: 5px; margin-top: 30px;'>Data Pasien :</p>
                        <table width="100%">
                            <!-- <pre> -->
                            <tbody>
                                <tr style="height: 3px;">
                                    <td width="20%">
                                        Nama
                                    </td>

                                    <td width="4%">
                                        :

                                    </td>

                                    <td>
                                        <?= Yii::$app->pasien->identity->nama_pasien ?>
                                    </td>
                                </tr>
                                <tr style="height: 20px;">
                                    <td width="20%">
                                        Jenis Kelamin
                                    </td>

                                    <td width="4%">
                                        :

                                    </td>

                                    <td>
                                        <?= Yii::$app->pasien->identity->id_jk == 1 ? "Laki-laki" : "Perempuan" ?>
                                    </td>
                                </tr>
                                <tr style="height: 20px;">
                                    <td width="20%">
                                        Umur
                                    </td>

                                    <td width="4%">
                                        :

                                    </td>

                                    <td>
                                        <?= date('Y', time()) - date('Y', strtotime(Yii::$app->pasien->identity->tgl_lahir)) ?>
                                    </td>
                                </tr>
                                <tr style="height: 20px;">
                                    <td width="20%">
                                        Alamat
                                    </td>

                                    <td width="4%">
                                        :

                                    </td>

                                    <td>
                                        <?= Yii::$app->pasien->identity->alamat ?>
                                    </td>
                                </tr>
                                <tr style="height: 20px;">
                                    <td width="20%">
                                        No HP
                                    </td>

                                    <td width="4%">
                                        :

                                    </td>

                                    <td>
                                        <?= Yii::$app->pasien->identity->no_hp ?>
                                    </td>
                                </tr>
                            </tbody>


                        </table>

                        <p style='color:#3fbbc0; font-size:17pt; font-weight:bold; margin-bottom: 5px; margin-top: 30px;'>Berdasarkan gejala yang dialami pasien yaitu :</p>
                        <?php
                        $data = $gejala_pilihan['data_gejala'];
                        $i = 1;
                        foreach ($data as $value) {
                            if (count($data) <= 2 && $i == 1) {
                                echo "$value ";
                            } elseif ($i < count($data)) {
                                echo "$value, ";
                            } else {
                                echo "dan $value";
                            }
                            $i++;
                        }

                        ?>
                        <p style='color:#3fbbc0; font-size:17pt; font-weight:bold; margin-bottom: 5px; margin-top: 10px;'>Maka dapat disimpulkan penyakit :</p>
                        <?php 
                            $no = 1;
                            foreach($gejala_pilihan['hasil'] as $daftar_gejala):
                                $penyakit = $daftar_gejala['id_penyakit'];
                                $nilai = $daftar_gejala["total"];
                        ?>
                        <table width="100%">
                            <!-- <pre> -->
                            <tbody>
                                <tr style="height: 3px;">
                                    <td width="30%" colspan="3">
                                        <b><?= $no.'. '.$penyakit->nama_penyakit ?></b>
                                    </td>

                                    <td>
                                       
                                    </td>
                                </tr>
                                <tr style="height: 3px;">
                                    <td width="30%" style="vertical-align:top;">
                                        Deskripsi
                                    </td>

                                    <td width="4%" style="vertical-align:top;">
                                        :

                                    </td>
                                    <td>
                                        <?= $penyakit->deskripsi_penyakit ?>
                                    </td>
                                </tr>
                                <tr style="height: 30px;">
                                    <td width="30%" style="vertical-align:top;">
                                        Penyebab
                                    </td>

                                    <td width="4%" style="vertical-align:top;">
                                        :

                                    </td>

                                    <td>
                                        <?php
                                            $data_penyebab = $penyakit->penyebabPenyakits;
                                            $i = 1;
                                            foreach ($data_penyebab as $value) {
                                                if (count($data_penyebab) <= 2 && $i == 1) {
                                                    echo "{$value->penyebab->penyebab} "; 
                                                } elseif ($i < count($data_penyebab)) {
                                                    echo "{$value->penyebab->penyebab}, ";
                                                } else {
                                                    echo "dan {$value->penyebab->penyebab}";
                                                }
                                                $i++;
                                            }

                                            ?>
                                    </td>
                                </tr>
                                <tr style="height: 30px;">
                                    <td width="30%" style="vertical-align:top;">
                                        Cara Penanganan
                                    </td>

                                    <td width="4%" style="vertical-align:top;">
                                        :

                                    </td>

                                    <td>
                                        <?php
                                            $data_penanganan = $penyakit->penangananPenyakits;
                                            $i = 1;
                                            foreach ($data_penanganan as $value) {
                                                if (count($data_penanganan) <= 2 && $i == 1) {
                                                    echo "{$value->penanganan->penanganan} "; 
                                                } elseif ($i < count($data_penanganan)) {
                                                    echo "{$value->penanganan->penanganan}, ";
                                                } else {
                                                    echo "dan {$value->penanganan->penanganan}";
                                                }
                                                $i++;
                                            }

                                            ?>
                                    </td>
                                </tr>
                                <tr style="height: 30px;">
                                    <td width="30%" style="vertical-align:top;">
                                        Diagnosis Sistem
                                    </td>

                                    <td width="4%" style="vertical-align:top;">
                                        :

                                    </td>

                                    <td>
                                    <?= round( $nilai,2) ?>.
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        <?php
                            $no++;
                            endforeach;
                            ?>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="alert alert-info">
                            Untuk melakukan diagnosa ulang, silahkan hubungi admin.
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</section>