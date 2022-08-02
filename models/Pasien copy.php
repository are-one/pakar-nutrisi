<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id_pasien
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $nama
 * @property string $alamat
 * @property string $umur
 * @property string|null $usia_kandungan
 * @property int|null $pertambahan_bb
 * @property string|null $hb
 * @property string|null $status
 * @property int $ahli_gizi_id_ahli
 *
 * @property AhliGizi $ahliGiziIdAhli
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'nama', 'alamat', 'umur', 'ahli_gizi_id_ahli'], 'required'],
            [['pertambahan_bb', 'ahli_gizi_id_ahli'], 'integer'],
            [['username', 'status'], 'string', 'max' => 50],
            [['password', 'email', 'nama'], 'string', 'max' => 100],
            [['alamat'], 'string', 'max' => 255],
            [['umur', 'usia_kandungan', 'hb'], 'string', 'max' => 10],
            [['username'], 'unique'],
            [['ahli_gizi_id_ahli'], 'exist', 'skipOnError' => true, 'targetClass' => AhliGizi::className(), 'targetAttribute' => ['ahli_gizi_id_ahli' => 'id_ahli']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pasien' => 'Id Pasien',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'umur' => 'Umur',
            'usia_kandungan' => 'Usia Kandungan',
            'pertambahan_bb' => 'Pertambahan Bb',
            'hb' => 'Hb',
            'status' => 'Status',
            'ahli_gizi_id_ahli' => 'Ahli Gizi Id Ahli',
        ];
    }

    /**
     * Gets query for [[AhliGiziIdAhli]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAhliGiziIdAhli()
    {
        return $this->hasOne(AhliGizi::className(), ['id_ahli' => 'ahli_gizi_id_ahli']);
    }
}
