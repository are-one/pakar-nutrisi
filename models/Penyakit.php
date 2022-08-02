<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penyakit".
 *
 * @property string $id_penyakit
 * @property string $nama_penyakit
 *
 * @property Diagnosis[] $diagnoses
 */
class Penyakit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penyakit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_penyakit', 'nama_penyakit'], 'required'],
            [['id_penyakit'], 'string', 'max' => 10],
            [['nama_penyakit'], 'string', 'max' => 100],
            [['id_penyakit'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_penyakit' => 'Id Penyakit',
            'nama_penyakit' => 'Nama Penyakit',
        ];
    }

    /**
     * Gets query for [[Diagnoses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnoses()
    {
        return $this->hasMany(Diagnosis::className(), ['penyakit_id_penyakit' => 'id_penyakit']);
    }
}
