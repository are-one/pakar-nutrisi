<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengobatan".
 *
 * @property string $id_pengobatan
 * @property string $pengobatan
 *
 * @property PenyakitHasPengobatan[] $penyakitHasPengobatans
 * @property Penyakit[] $penyakits
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
     * Gets query for [[PenyakitHasPengobatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenyakitHasPengobatans()
    {
        return $this->hasMany(PenyakitHasPengobatan::className(), ['pengobatan_id' => 'id_pengobatan']);
    }

    /**
     * Gets query for [[Penyakits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenyakits()
    {
        return $this->hasMany(Penyakit::className(), ['id_penyakit' => 'penyakit_id'])->viaTable('penyakit_has_pengobatan', ['pengobatan_id' => 'id_pengobatan']);
    }
}
