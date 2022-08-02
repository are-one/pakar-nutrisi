<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diagnosis".
 *
 * @property string $id_diagnosis
 * @property string $pengobatan_id
 * @property string $penyakit_id
 * @property string|null $hasil_diagnosis
 * @property string|null $kondisi
 *
 * @property Pengobatan $pengobatan
 * @property Penyakit $penyakit
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
            [['id_diagnosis', 'pengobatan_id', 'penyakit_id'], 'required'],
            [['hasil_diagnosis'], 'string'],
            [['id_diagnosis', 'pengobatan_id', 'penyakit_id'], 'string', 'max' => 10],
            [['kondisi'], 'string', 'max' => 100],
            [['id_diagnosis'], 'unique'],
            [['pengobatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pengobatan::className(), 'targetAttribute' => ['pengobatan_id' => 'id_pengobatan']],
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
            'pengobatan_id' => 'Pengobatan ID',
            'penyakit_id' => 'Penyakit ID',
            'hasil_diagnosis' => 'Hasil Diagnosis',
            'kondisi' => 'Kondisi',
        ];
    }

    /**
     * Gets query for [[Pengobatan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPengobatan()
    {
        return $this->hasOne(Pengobatan::className(), ['id_pengobatan' => 'pengobatan_id']);
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
        return [
            'R1' => [['muda', 'trisemester_1', 'rendah', 'kurang'],'anemia_berat'],
            'R2' => [['muda', 'trisemester_1', 'rendah', 'normal'],'anemia_ringan'],
            'R3' => [['muda', 'trisemester_1', 'rendah', 'tinggi'],'anemia_ringan'],
            'R4' => [['muda', 'trisemester_1', 'normal', 'kurang'],'anemia_sedang'],
            'R5' => [['muda', 'trisemester_1', 'normal', 'normal'],'normal'],
            'R6' => [['muda', 'trisemester_1', 'normal', 'tinggi'],'normal'],
            'R7' => [['muda', 'trisemester_1', 'kegemukan', 'kurang'],'anemia_ringan'],
            'R8' => [['muda', 'trisemester_1', 'kegemukan', 'normal'],'normal'],
            'R9' => [['muda', 'trisemester_1', 'kegemukan', 'tinggi'],'normal'],
            'R10' => [['muda', 'trisemester_1', 'obesitas', 'kurang'],'anemia_ringan'],
            'R11' => [['muda', 'trisemester_1', 'obesitas', 'normal'],'normal'],
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