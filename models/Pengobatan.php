<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengobatan".
 *
 * @property string $id_pengobatan
 * @property string $pengobatan
 *
 * @property Diagnosis[] $diagnoses
 */
class Pengobatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengobatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pengobatan', 'pengobatan'], 'required'],
            [['id_pengobatan'], 'string', 'max' => 10],
            [['pengobatan'], 'string', 'max' => 255],
            [['id_pengobatan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pengobatan' => 'Id Pengobatan',
            'pengobatan' => 'Pengobatan',
        ];
    }

    /**
     * Gets query for [[Diagnoses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnoses()
    {
        return $this->hasMany(Diagnosis::className(), ['pengobatan_id_pengobatan' => 'id_pengobatan']);
    }
}
