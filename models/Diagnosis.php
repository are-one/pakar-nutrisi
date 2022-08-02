<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diagnosis".
 *
 * @property int $id_diagnosis
 * @property string|null $hasil_diagnosis
 * @property string|null $kondisi
 * @property string|null $created_at 
 * @property int $pasien_id 
 * @property string $penyakit_id 
 *
 * @property Pasien $pasien
 */
class Diagnosis extends \yii\db\ActiveRecord
{
    public $usia_ibu_hamil;
    public $usia_kandungan;
    public $pertambahan_bb;
    public $hemoglobin;
    const SCENARIO_DIAGNOSA = 'diagnosa'; 

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnosis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hasil_diagnosis'], 'string'],
            [['created_at'], 'safe'],
            [['pasien_id', 'penyakit_id'], 'required'],
            [['pasien_id'], 'integer'],
            [['kondisi'], 'string', 'max' => 100],
            [['penyakit_id'], 'string', 'max' => 10],
            [['pasien_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pasien::className(), 'targetAttribute' => ['pasien_id' => 'id_pasien']],
            [['penyakit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penyakit::className(), 'targetAttribute' => ['penyakit_id' => 'id_penyakit']],
            [['usia_ibu_hamil', 'usia_kandungan', 'pertambahan_bb', 'hemoglobin'], 'required','on' => self::SCENARIO_DIAGNOSA],
            [['usia_ibu_hamil', 'usia_kandungan', 'pertambahan_bb', 'hemoglobin'], 'string', 'max' => 10],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_diagnosis' => 'Id Diagnosis',
            'hasil_diagnosis' => 'Hasil Diagnosis',
            'kondisi' => 'Kondisi',
            'created_at' => 'Created At', 
            'pasien_id' => 'Pasien ID', 
            'penyakit_id' => 'Penyakit ID', 
        ];
    }

    
   /**
    * Gets query for [[Pasien]].
    *
    * @return \yii\db\ActiveQuery
    */
   public function getPasien()
   {
       return $this->hasOne(Pasien::className(), ['id_pasien' => 'pasien_id']);
   }
   
    /**
     * Gets query for [[Penyakit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenyakit()
    {
        return $this->hasOne(Penyakit::className(), ['id_penyakit' => 'penyakit_id']);
    }

    public static function getRules(){

        // P01 - Anemia Berat (anemia_berat)
        // P02 - Anemia Sedang (anemia_sedang)
        // P03 - Anemia Ringan (anemia_ringan)
        // P04 - Normal (normal)
        // P05 - Hipertensi Ringan (hipertensi_ringan)
        // P06 - Hipertensi Sedang (hipertensi_sedang)
        // P07 - Hipertensi Berat (hipertensi_berat)

        return [
            'R1' => [['muda', 'trisemester_1', 'rendah', 'kurang'],'P01'],
            'R2' => [['muda', 'trisemester_1', 'rendah', 'normal'],'P03'],
            'R3' => [['muda', 'trisemester_1', 'rendah', 'tinggi'],'P03'],
            'R4' => [['muda', 'trisemester_1', 'normal', 'kurang'],'P02'],
            'R5' => [['muda', 'trisemester_1', 'normal', 'normal'],'P04'],
            'R6' => [['muda', 'trisemester_1', 'normal', 'tinggi'],'P04'],
            'R7' => [['muda', 'trisemester_1', 'kegemukan', 'kurang'],'P03'],
            'R8' => [['muda', 'trisemester_1', 'kegemukan', 'normal'],'P04'],
            'R9' => [['muda', 'trisemester_1', 'kegemukan', 'tinggi'],'P04'],
            'R10' => [['muda', 'trisemester_1', 'obesitas', 'kurang'],'P03'],
            'R11' => [['muda', 'trisemester_1', 'obesitas', 'normal'],'P04'],
            'R12' => [['muda', 'trisemester_1', 'obesitas', 'tinggi'],'P04'],
            'R13' => [['muda', 'trisemester_2', 'rendah', 'kurang'],'P03'],
            'R14' => [['muda', 'trisemester_2', 'rendah', 'normal'],'P04'],
            'R15' => [['muda', 'trisemester_2', 'rendah', 'tinggi'],'P04'],
            'R16' => [['muda', 'trisemester_2', 'normal', 'kurang'],'P03'],
            'R17' => [['muda', 'trisemester_2', 'normal', 'normal'],'P04'],
            'R18' => [['muda', 'trisemester_2', 'normal', 'tinggi'],'P05'],
            'R19' => [['muda', 'trisemester_2', 'kegemukan', 'kurang'],'P04'],
            'R20' => [['muda', 'trisemester_2', 'kegemukan', 'normal'],'P04'],
            'R21' => [['muda', 'trisemester_2', 'kegemukan', 'tinggi'],'P05'],
            'R22' => [['muda', 'trisemester_2', 'obesitas', 'kurang'],'P04'],
            'R23' => [['muda', 'trisemester_2', 'obesitas', 'normal'],'P05'],
            'R24' => [['muda', 'trisemester_2', 'obesitas', 'tinggi'],'P06'],
            'R25' => [['muda', 'trisemester_3', 'rendah', 'kurang'],'P02'],
            'R26' => [['muda', 'trisemester_3', 'rendah', 'normal'],'P04'],
            'R27' => [['muda', 'trisemester_3', 'rendah', 'tinggi'],'P04'],
            'R28' => [['muda', 'trisemester_3', 'normal', 'kurang'],'P02'],
            'R29' => [['muda', 'trisemester_3', 'normal', 'normal'],'P04'],
            'R30' => [['muda', 'trisemester_3', 'normal', 'tinggi'],'P04'],
            'R31' => [['muda', 'trisemester_3', 'kegemukan', 'kurang'],'P03'],
            'R32' => [['muda', 'trisemester_3', 'kegemukan', 'normal'],'P04'],
            'R33' => [['muda', 'trisemester_3', 'kegemukan', 'tinggi'],'P04'],
            'R34' => [['muda', 'trisemester_3', 'obesitas', 'kurang'],'P04'],
            'R35' => [['muda', 'trisemester_3', 'obesitas', 'normal'],'P04'],
            'R36' => [['muda', 'trisemester_3', 'obesitas', 'tinggi'],'P05'],
            'R37' => [['parobaya', 'trisemester_1', 'rendah', 'kurang'],'P02'],
            'R38' => [['parobaya', 'trisemester_1', 'rendah', 'normal'],'P04'],
            'R39' => [['parobaya', 'trisemester_1', 'rendah', 'tinggi'],'P04'],
            'R40' => [['parobaya', 'trisemester_1', 'normal', 'kurang'],'P02'],
            'R41' => [['parobaya', 'trisemester_1', 'normal', 'normal'],'P04'],
            'R42' => [['parobaya', 'trisemester_1', 'normal', 'tinggi'],'P04'],
            'R43' => [['parobaya', 'trisemester_1', 'kegemukan', 'kurang'],'P03'],
            'R44' => [['parobaya', 'trisemester_1', 'kegemukan', 'normal'],'P04'],
            'R45' => [['parobaya', 'trisemester_1', 'kegemukan', 'tinggi'],'P04'],
            'R46' => [['parobaya', 'trisemester_1', 'obesitas', 'kurang'],'P04'],
            'R47' => [['parobaya', 'trisemester_1', 'obesitas', 'normal'],'P04'],
            'R48' => [['parobaya', 'trisemester_1', 'obesitas', 'tinggi'],'P05'],
            'R49' => [['parobaya', 'trisemester_2', 'rendah', 'kurang'],'P03'],
            'R50' => [['parobaya', 'trisemester_2', 'rendah', 'normal'],'P04'],
            'R51' => [['parobaya', 'trisemester_2', 'rendah', 'tinggi'],'P04'],
            'R52' => [['parobaya', 'trisemester_2', 'normal', 'kurang'],'P04'],
            'R53' => [['parobaya', 'trisemester_2', 'normal', 'normal'],'P04'],
            'R54' => [['parobaya', 'trisemester_2', 'normal', 'tinggi'],'P05'],
            'R55' => [['parobaya', 'trisemester_2', 'kegemukan', 'kurang'],'P04'],
            'R56' => [['parobaya', 'trisemester_2', 'kegemukan', 'normal'],'P05'],
            'R57' => [['parobaya', 'trisemester_2', 'kegemukan', 'tinggi'],'P06'],
            'R58' => [['parobaya', 'trisemester_2', 'obesitas', 'kurang'],'P04'],
            'R59' => [['parobaya', 'trisemester_2', 'obesitas', 'normal'],'P06'],
        ];
    }

    // sumber kode : https://stackoverflow.com/questions/8567082/how-to-generate-in-php-all-combinations-of-items-in-multiple-arrays
    public static function combinations($arrays, $i = 0) {
        $keys = array_keys($arrays);
        
        if (!isset($arrays[$keys[$i]])) {
            return array();
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$keys[$i]];
        }
    
        // get combinations from subsequent arrays
        $tmp = self::combinations($arrays, $i + 1);
    
        $result = array();
    
        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$keys[$i]] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ? 
                    array_merge(array($v), $t) :
                    array($v, $t);
            }
        }
    
        return $result;
    }
}