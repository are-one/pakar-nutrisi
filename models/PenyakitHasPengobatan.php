<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penyakit_has_pengobatan".
 *
 * @property string $penyakit_id
 * @property string $pengobatan_id
 *
 * @property Pengobatan $pengobatan
 * @property Penyakit $penyakit
 */
class PenyakitHasPengobatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penyakit_has_pengobatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['penyakit_id', 'pengobatan_id'], 'required'],
            [['penyakit_id', 'pengobatan_id'], 'string', 'max' => 10],
            [['penyakit_id', 'pengobatan_id'], 'unique', 'targetAttribute' => ['penyakit_id', 'pengobatan_id']],
            [['pengobatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pengobatan::className(), 'targetAttribute' => ['pengobatan_id' => 'id_pengobatan']],
            [['penyakit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penyakit::className(), 'targetAttribute' => ['penyakit_id' => 'id_penyakit']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'penyakit_id' => 'Penyakit ID',
            'pengobatan_id' => 'Pengobatan ID',
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
}
