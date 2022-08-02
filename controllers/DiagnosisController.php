<?php

namespace app\controllers;

use Yii;
use app\models\Diagnosis;
use app\models\Pasien;
use app\models\search\DiagnosisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\ServerErrorHttpException;

/**
 * DiagnosisController implements the CRUD actions for Diagnosis model.
 */
class DiagnosisController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Diagnosis models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new DiagnosisSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
        $userId = Yii::$app->pasien->identity->id;
        // $ahliId = Yii::$app->pasien->identity->ahli_gizi_id;
        
        // try {
            $transaction = Yii::$app->db->beginTransaction();
            
            if($userId){
                $pasien = Pasien::findOne(['id_pasien' => $userId]);
                
                $model = new Diagnosis();
                $model->scenario = $model::SCENARIO_DIAGNOSA;
                $model->pasien_id = $pasien->id_pasien;
                $model->usia_ibu_hamil = $pasien->umur;
                $model->usia_kandungan = $pasien->usia_kandungan;
                $model->pertambahan_bb = $pasien->pertambahan_bb;
                $model->hemoglobin = $pasien->hb;
            
                if ($model->load(Yii::$app->request->post()) ) {
                    $result =  $this->fuzzyTsukamoto($model->getAttributes(['usia_ibu_hamil', 'usia_kandungan','pertambahan_bb','hemoglobin']));
                    $model->penyakit_id = $result[0];
                    $model->created_at = date('Y-m-d H:i:s');

                    $pasien->umur = $model->usia_ibu_hamil;
                    $pasien->usia_kandungan = $model->usia_kandungan;
                    $pasien->pertambahan_bb = $model->pertambahan_bb;
                    $pasien->hb = $model->hemoglobin;

                    if($model->save() && $pasien->save()){
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Diagnosa dan Update data berhasil diproses');
                    }else{
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', 'Diagnosa dan Update data gagal diproses');
                    }
                    
                }
                
                return $this->render('index', [
                    'model' => $model,
                ]);
                
            }else{
                $transaction->rollBack();
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        // } catch (\Exception $e) {
        //     $transaction->rollBack();
        //     throw new ServerErrorHttpException('Terjadi Masalah');
        // }
    }

    /**
     * Displays a single Diagnosis model.
     * @param string $id_diagnosis
     * @param string $pengobatan_id_pengobatan
     * @param string $penyakit_id_penyakit
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_diagnosis, $pengobatan_id_pengobatan, $penyakit_id_penyakit)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_diagnosis, $pengobatan_id_pengobatan, $penyakit_id_penyakit),
        ]);
    }

    /**
     * Creates a new Diagnosis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Diagnosis();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_diagnosis' => $model->id_diagnosis, 'pengobatan_id_pengobatan' => $model->pengobatan_id_pengobatan, 'penyakit_id_penyakit' => $model->penyakit_id_penyakit]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Diagnosis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id_diagnosis
     * @param string $pengobatan_id_pengobatan
     * @param string $penyakit_id_penyakit
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_diagnosis, $pengobatan_id_pengobatan, $penyakit_id_penyakit)
    {
        $model = $this->findModel($id_diagnosis, $pengobatan_id_pengobatan, $penyakit_id_penyakit);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_diagnosis' => $model->id_diagnosis, 'pengobatan_id_pengobatan' => $model->pengobatan_id_pengobatan, 'penyakit_id_penyakit' => $model->penyakit_id_penyakit]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Diagnosis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id_diagnosis
     * @param string $pengobatan_id_pengobatan
     * @param string $penyakit_id_penyakit
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_diagnosis, $pengobatan_id_pengobatan, $penyakit_id_penyakit)
    {
        $this->findModel($id_diagnosis, $pengobatan_id_pengobatan, $penyakit_id_penyakit)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Diagnosis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id_diagnosis
     * @param string $pengobatan_id_pengobatan
     * @param string $penyakit_id_penyakit
     * @return Diagnosis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_diagnosis, $pengobatan_id_pengobatan, $penyakit_id_penyakit)
    {
        if (($model = Diagnosis::findOne(['id_diagnosis' => $id_diagnosis, 'pengobatan_id_pengobatan' => $pengobatan_id_pengobatan, 'penyakit_id_penyakit' => $penyakit_id_penyakit])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function diagnosa(Array $inputan)
    {
        
    }

    private function fuzzyTsukamoto(Array $inputan)
    {
        $fuzzyfikasi = [];

        foreach ($inputan as $key => $value) {
            if($key == 'usia_ibu_hamil'){
                $fuzzyfikasi[$key] = $this->keanggotaanInputUsiaIbuHamil($value);
            }elseif($key == 'usia_kandungan'){
                $fuzzyfikasi[$key] = $this->keanggotaanInputUsiaKandungan($value);
            }elseif($key == 'pertambahan_bb'){
                $fuzzyfikasi[$key] = $this->keanggotaanInputPertambahanBb($value);
            }elseif($key == 'hemoglobin'){
                $fuzzyfikasi[$key] = $this->keanggotaanInputHemoglobin($value);
            }
        }
        
        // Mengambil data nilai keanggotaan yang tidak bernilai 0
        $dataNilaiKeanggotaan = $this->filterKeanggotaan($fuzzyfikasi);
        
        // Mengambil nilai linguistik dari hasil perhitungan fungsi keanggotaan
        $linguistikKeanggotaan = $this->getLinguistic($dataNilaiKeanggotaan);
        
        // buat kombinasi fungsi keanggotaan untuk dicocokkan dgn rule yang ada
        $kombinasi = Diagnosis::combinations($linguistikKeanggotaan);
        
        // mencocokkan rule yang sesuai
        $ruleSesuai = $this->sesuaikanRule($kombinasi);
        
        // proses inferensi
        $inferensi = $this->inferensi($dataNilaiKeanggotaan, $ruleSesuai);
        [$alphaPredikatRule, $z] = $inferensi;
        
        // proses defuzzyfikasi => Menentukan hasil
        $defuzzyfikasi = $this->defuzzyfikasi($alphaPredikatRule, $z);
        
        // print_r($ruleSesuai);die;
        return $defuzzyfikasi;
    }

    private function keanggotaanInputUsiaIbuHamil($nilai)
    {
        $hasilKeanggotaan = [];

        // Muda => parameter = [17, 20, 30]
        if($nilai <= 20){
            $hasilKeanggotaan['muda'] = 1;
        }elseif($nilai >= 20 && $nilai <= 30){
            $hasilKeanggotaan['muda'] = round((float) (30 - $nilai)/(30-20), 2);
        }elseif($nilai >= 30){
            $hasilKeanggotaan['muda'] = 0;
        }

        // Parobaya => parameter = [20, 30, 35, 40]
        if($nilai <= 20 || $nilai >= 40){
            $hasilKeanggotaan['parobaya'] = 0;
        }elseif($nilai > 20 && $nilai < 30){
            $hasilKeanggotaan['parobaya'] = round((float) ($nilai - 20)/(30 -20), 2);
        }elseif($nilai >= 30 && $nilai <= 35){
            $hasilKeanggotaan['parobaya'] = 1;
        }elseif($nilai > 35 && $nilai < 40){
            $hasilKeanggotaan['parobaya'] = round((float) (40 - $nilai)/(40 - 35), 2);
        }

        // Tua => parameter = [20, 30, 35, 40]
        if($nilai <= 35){
            $hasilKeanggotaan['tua'] = 0;
        }elseif($nilai > 35 && $nilai < 40){
            $hasilKeanggotaan['tua'] = round((float) ($nilai - 35)/(40 -35), 2);
        }elseif($nilai >= 40){
            $hasilKeanggotaan['tua'] = 1;
        }

        return $hasilKeanggotaan;

    }

    private function keanggotaanInputUsiaKandungan($nilai)
    {
        $hasilKeanggotaan = [];             

        // Trisemester 1 => parameter = [0, 10, 15]
        if($nilai <= 10){
            $hasilKeanggotaan['trisemester_1'] = 1;
        }elseif($nilai > 10 && $nilai < 15){
            $hasilKeanggotaan['trisemester_1'] = round((float) (15 - $nilai)/(15 - 10), 2);
        }elseif($nilai >= 15){
            $hasilKeanggotaan['trisemester_1'] = 0;
        }

        // Trisemester 2 => parameter = [10, 25, 28]
        if($nilai <= 10 || $nilai >= 28){
            $hasilKeanggotaan['trisemester_2'] = 0;
        }elseif($nilai > 10 && $nilai < 25){
            $hasilKeanggotaan['trisemester_2'] = round((float) ($nilai - 10)/(25 - 10), 2);
        }elseif($nilai == 25){
            $hasilKeanggotaan['trisemester_2'] = 1;
        }elseif($nilai >= 25 && $nilai < 28){
            $hasilKeanggotaan['trisemester_2'] = round((float) (28 - $nilai)/(28 - 25), 2);
        }

        // Trisemester 3 => parameter = [25, 40]
        if($nilai <= 25){
            $hasilKeanggotaan['trisemester_3'] = 0;
        }elseif($nilai > 25 && $nilai < 28){
            $hasilKeanggotaan['trisemester_3'] = round((float) ($nilai - 28)/(28 - 25), 2);
        }elseif($nilai >= 20){
            $hasilKeanggotaan['trisemester_3'] = 1;
        }

        return $hasilKeanggotaan;

    }

    public function keanggotaanInputPertambahanBb($nilai)
    {
        $hasilKeanggotaan = [];

        // Rendah => parameter = [0, 17, 18]
        if($nilai <= 17){
            $hasilKeanggotaan['rendah'] = 1;
        }elseif($nilai > 17 && $nilai < 18){
            $hasilKeanggotaan['rendah'] = round((float) (18 - $nilai)/(18 - 17), 2);
        }elseif($nilai >= 18){
            $hasilKeanggotaan['rendah'] = 0;
        }

        // Normal => parameter = [17, 24, 25]
        if($nilai <= 17 || $nilai >= 25){
            $hasilKeanggotaan['normal'] = 0;
        }elseif($nilai > 17 && $nilai < 24){
            $hasilKeanggotaan['normal'] = round((float) ($nilai - 17)/(24 - 17), 2);
        }elseif($nilai >= 24 && $nilai < 25){
            $hasilKeanggotaan['normal'] = round((float) (25 - $nilai)/(25 - 24), 2);
        }elseif($nilai == 24){
            $hasilKeanggotaan['normal'] = 1;
        }

        // Kegemukan => parameter = [24, 29, 30]
        if($nilai <= 24 || $nilai >= 30){
            $hasilKeanggotaan['kegemukan'] = 0;
        }elseif($nilai > 24 && $nilai < 29){
            $hasilKeanggotaan['kegemukan'] = round((float) ($nilai - 24)/(29 - 24), 2);
        }elseif($nilai == 29){
            $hasilKeanggotaan['kegemukan'] = 1;
        }elseif($nilai >= 29 && $nilai < 30){
            $hasilKeanggotaan['kegemukan'] = round((float) (30 - $nilai)/(30 - 29), 2);
        }
        
        // Obesitas => parameter = [30, 40]
        if($nilai <= 29){
            $hasilKeanggotaan['obesitas'] = 0;
        }elseif($nilai > 29 && $nilai < 40){
            $hasilKeanggotaan['obesitas'] = round((float) ($nilai - 29)/(40 - 29), 2);
        }elseif($nilai >= 20){
            $hasilKeanggotaan['obesitas'] = 1;
        }

        return $hasilKeanggotaan;
    }
    
    public function keanggotaanInputHemoglobin($nilai)
    {
        $hasilKeanggotaan = [];

        // Kurang => parameter = [0, 10, 15]
        if($nilai <= 10){
            $hasilKeanggotaan['kurang'] = 1;
        }elseif($nilai > 10 && $nilai < 15){
            $hasilKeanggotaan['kurang'] = round((float) (15 - $nilai)/(15 - 10), 2);
        }elseif($nilai >= 15){
            $hasilKeanggotaan['kurang'] = 0;
        }

        // Normal => parameter = [10, 15, 20]
        if($nilai <= 10 || $nilai >= 20){
            $hasilKeanggotaan['normal'] = 0;
        }elseif($nilai > 10 && $nilai < 15){
            $hasilKeanggotaan['normal'] = round((float) ($nilai - 10)/(15 - 10), 2);
        }elseif($nilai == 15){
            $hasilKeanggotaan['normal'] = 1;
        }elseif($nilai > 15 && $nilai < 20){
            $hasilKeanggotaan['normal'] = round((float) (20 - $nilai)/(20 - 15), 2);
        }

        // Lebih => parameter = [15, 20]
        if($nilai <= 15){
            $hasilKeanggotaan['tinggi'] = 0;
        }elseif($nilai > 15 && $nilai < 20){
            $hasilKeanggotaan['tinggi'] = round((float) ($nilai - 15)/(20 -15), 2);
        }elseif($nilai >= 20){
            $hasilKeanggotaan['tinggi'] = 1;
        }

        return $hasilKeanggotaan;
    }

    public function keanggotaanOutputKondisiIbuHamil($nilai)
    {    
        $hasilKeanggotaan = [];

        // Anemia Berat => parameter = [5, 7, 9]
        if($nilai <= 7){
            $hasilKeanggotaan['P01'] = 1;
        }elseif($nilai > 7 && $nilai < 9){
            $hasilKeanggotaan['P01'] = round((float) (9 - $nilai)/(9 - 7), 2);
        }elseif($nilai >= 9){
            $hasilKeanggotaan['P01'] = 0;
        }

        // Anemia Sedang => parameter = [7, 9, 11]
        if($nilai <= 7 || $nilai >= 11){
            $hasilKeanggotaan['P02'] = 0;
        }elseif($nilai > 7 && $nilai < 9){
            $hasilKeanggotaan['P02'] = round((float) ($nilai - 7)/(9 - 7), 2);
        }elseif($nilai == 9){
            $hasilKeanggotaan['P02'] = 1;
        }elseif($nilai > 9 && $nilai < 11){
            $hasilKeanggotaan['P02'] = round((float) (11 - $nilai)/(11 - 9), 2);
        }

        // Anemia Ringan => parameter = [9, 11, 13]
        if($nilai <= 9 || $nilai >= 13){
            $hasilKeanggotaan['P03'] = 0;
        }elseif($nilai > 9 && $nilai < 11){
            $hasilKeanggotaan['P03'] = round((float) ($nilai - 9)/(11 - 9), 2);
        }elseif($nilai == 11){
            $hasilKeanggotaan['P03'] = 1;
        }elseif($nilai >= 11 && $nilai < 13){
            $hasilKeanggotaan['P03'] = round((float) (13 - $nilai)/(13 - 11), 2);
        }

        // Normal => parameter = [11, 13, 15, 17]
        if($nilai <= 11 || $nilai >= 17){
            $hasilKeanggotaan['P04'] = 0;
        }elseif($nilai > 11 && $nilai < 13){
            $hasilKeanggotaan['P04'] = round((float) ($nilai - 11)/(13 -11), 2);
        }elseif($nilai >= 13 && $nilai <= 15){
            $hasilKeanggotaan['P04'] = 1;
        }elseif($nilai > 15 && $nilai < 17){
            $hasilKeanggotaan['P04'] = round((float) (17 - $nilai)/(17 - 15), 2);
        }

        // Hipertensi Ringan => parameter = [15, 17, 19]
        if($nilai <= 15 || $nilai >= 19){
            $hasilKeanggotaan['P05'] = 0;
        }elseif($nilai > 15 && $nilai < 17){
            $hasilKeanggotaan['P05'] = round((float) ($nilai - 15)/(17 - 15), 2);
        }elseif($nilai == 17){
            $hasilKeanggotaan['P05'] = 1;
        }elseif($nilai > 17 && $nilai < 19){
            $hasilKeanggotaan['P05'] = round((float) (19 - $nilai)/(19 - 17), 2);
        }
        
        // Hipertensi Sedang => parameter = [17, 19, 20]
        if($nilai <= 17 || $nilai >= 20){
            $hasilKeanggotaan['P06'] = 0;
        }elseif($nilai > 17 && $nilai < 19){
            $hasilKeanggotaan['P06'] = round((float) ($nilai - 17)/(19 - 17), 2);
        }elseif($nilai == 19){
            $hasilKeanggotaan['P06'] = 1;
        }elseif($nilai >= 19 && $nilai < 20){
            $hasilKeanggotaan['P06'] = round((float) (20 - $nilai)/(20 - 19), 2);
        }

        // Hipertensi Berat => parameter = [19, 20]
        if($nilai <= 19){
            $hasilKeanggotaan['P07'] = 0;
        }elseif($nilai > 19 && $nilai < 20){
            $hasilKeanggotaan['P07'] = round((float) ($nilai - 19)/(20 - 19), 2);
        }elseif($nilai >= 19){
            $hasilKeanggotaan['P07'] = 1;
        }
            

        return $hasilKeanggotaan;
    }

    // END OF KEANGGOTAAN ==============================================================================

    private function filterKeanggotaan($dataNilaiKeanggotaan)
    {
        $hasil = [];

        foreach ($dataNilaiKeanggotaan as $variable => $dataNilai) {
            // Ambil data nilai keanggotaan yang tidak bernilai 0
            $hasil[$variable] = array_filter($dataNilai,function($nilai)
                                {
                                    return $nilai != 0;
                                });
        }
        
        return $hasil;
    }
    
    private function getLinguistic($dataKeanggotaan)
    {
        $result = array();

        // Ambil nilai linguistik yang akan di cocokkan dengan rule
        foreach ($dataKeanggotaan as $variabel => $dataNilai) {
            $result[$variabel] = array_keys($dataNilai);
        }

        return $result;    
    }

    private function sesuaikanRule($kombinasiKeanggotaan)
    {
        $hasil = [];
        $rules = Diagnosis::getRules();

        $hasil = array_filter($rules,function($data) use ($kombinasiKeanggotaan)
        {
            $isMatch = false;
            foreach ($kombinasiKeanggotaan as $value) {
                if($value == $data[0]) {
                    $isMatch = true;
                    break; 
                }
            }

            return $isMatch;
        });
        
        return $hasil;
    }

    private function inferensi($dataNilaiKeanggotaan, $ruleSesuai)
    {
        $nilaiKeanggotaanRule = array();
        $keysVariabel = array_keys($dataNilaiKeanggotaan);
        
        // Mengabil nilai keanggotaan dari rule yang sesuai
        foreach ($ruleSesuai as $noRule => $data) {
            $dataLingiustikRule = $data[0];
            
            foreach ($dataLingiustikRule as $index => $nilaiLinguistik) {
                $keyVariabel = $keysVariabel[$index];
                $nilaiKeanggotaanRule[$noRule][] = $dataNilaiKeanggotaan[$keyVariabel][$nilaiLinguistik];
            }
        }
        
        // Proses MIN dari nilai keanggotaan tiap rule
        $alphaPredikatRule = [];
        foreach ($nilaiKeanggotaanRule as $noRule => $values) {
            $alphaPredikatRule[$noRule] = min($values);
        }
        
        $z = [];
        foreach ($alphaPredikatRule as $noRule => $alphaPredikat) {
            $outputLinguistik = $ruleSesuai[$noRule][1];
            $z[$noRule] = $this->domainOutput($outputLinguistik, $alphaPredikat);
        }

        return [$alphaPredikatRule, $z];
    }

    private function defuzzyfikasi($alphaPredikatRule, $z)
    {
        

        $defuzzyfikasi = 0;
        $totalZ = 0; // sum product z with alphaPredikat
        
        foreach ($z as $noRule => $zValue) {
            $totalZ += $alphaPredikatRule[$noRule] * $zValue;
        }
        $defuzzyfikasi = (float) $totalZ/(array_sum($alphaPredikatRule));

        $kesimpulan = $this->keanggotaanOutputKondisiIbuHamil($defuzzyfikasi);
        $keanggotaanTertinggi = max($kesimpulan);
        $kesimpulanLinguistik = array_keys($kesimpulan, $keanggotaanTertinggi);

        if(count($kesimpulanLinguistik) == 1){
            $kesimpulanLinguistik = $kesimpulanLinguistik[0];
        }

        return [$kesimpulanLinguistik, $keanggotaanTertinggi];
        
    }

    public function domainOutput($outputLinguistik, $alphaPredikat)
    {
        $z = [];
        $result = 0;


        if($outputLinguistik == 'P01') // anemia berat 
        {
             $z[] = 9 - ($alphaPredikat * (9-7));
        }
        elseif($outputLinguistik == 'P02') // Anemia Sedang
        {
            $z[] = ($alphaPredikat * (9-7)) + 7;
            $z[] = 11 - ($alphaPredikat * (11-9));
        }      
        elseif($outputLinguistik == 'P03')// Anemia Ringan
        {
            $z[] = ($alphaPredikat * (11-9)) + 9;
            $z[] = 13 - ($alphaPredikat * (13-11));

        }        
        elseif($outputLinguistik == 'P04') // Normal
        {
            $z[] = ($alphaPredikat * (13-11)) + 11;
            $z[] = 17 - ($alphaPredikat * (17-15));
        }
        elseif($outputLinguistik == 'P05') // Hipertensi Ringan
        {
            $z[] = ($alphaPredikat * (17 -15)) + 15;
            $z[] = 19 - ($alphaPredikat * (19-17));
        }
        elseif($outputLinguistik == 'P06') // Hipertensi Sedang
        {
            $z[] = ($alphaPredikat * (19-17)) + 17;
            $z[] = 20 - ($alphaPredikat * (20-19));
        }
        elseif($outputLinguistik == 'P07') // Hipertensi Berat
        {
            $z[] = ($alphaPredikat * (20-19)) + 19;
        }

        if(count($z) > 1){
            $result = max($z);
        }else{
            $result = $z[0];
        }

        return $result;
    }

}