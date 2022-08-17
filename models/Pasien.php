<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id_pasien
 * @property string $nama_pasien
 * @property string $tgl_lahir
 * @property string $alamat
 * @property string $no_hp
 * @property string $username
 * @property string $password
 * @property int $id_jk
 *
 * @property Diagnosis[] $diagnoses
 * @property JenisKelamin $jk
 */
class Pasien extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $ulangi_password;
    public $password_baru;
    public $ulangi_password_baru;

    public function _construct()
    {
        $this->id = $this->id_pasien;
    }

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
            [['username', 'password', 'email', 'nama', 'alamat', 'umur'], 'required'],
            [['pertambahan_bb', 'ahli_gizi_id'], 'integer'],
            [['username', 'status'], 'string', 'max' => 50],
            [['password', 'email', 'nama'], 'string', 'max' => 100],
            [['alamat'], 'string', 'max' => 255],
            [['umur', 'usia_kandungan', 'hb'], 'string', 'max' => 10],
            [['username'], 'unique'],
            [['email'],'email'],
            [['ahli_gizi_id'], 'exist', 'skipOnError' => true, 'targetClass' => AhliGizi::className(), 'targetAttribute' => ['ahli_gizi_id' => 'id_ahli']],
                                    
            ['ulangi_password_baru', 'required', 'message' => '{attribute} wajib diisi.', 'when' => function ($model) {
                return $model->password_baru != '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#pasien-password_baru').val() != '';
            }"],
            ['password_baru', 'string', 'min' => 6, 'tooShort' => '{attribute} minimal 6 karakter.'],
            ['ulangi_password_baru', 'compare', 'compareAttribute' => 'password_baru', 'message' => 'Ulangi password harus sama dengan "password baru"'],
            ['ulangi_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Ulangi password harus sama dengan password"'],
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
            'ahli_gizi_id' => 'Ahli Gizi Id',
            'ulangi_password' => 'Ulangi Password',
            'password_baru' => 'Password Baru',
            'ulangi_password_baru' => 'Ulangi Password',
        ];
    }

    /**
     * Gets query for [[AhliGizi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAhliGizi()
    {
        return $this->hasOne(AhliGizi::className(), ['id_ahli' => 'ahli_gizi_id']);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id_pasien' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented');
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        // throw new NotSupportedException('"getAuthKey" is not implemented');
        return Yii::$app->params['authKeyPasien'];
    }

    public function validateAuthKey($authKey)
    {
        // throw new NotSupportedException('"validateAuthKey" is not implemented');
        return Yii::$app->params['authKeyPasien'] === $authKey;
    }

    // public function setPassword($password)
    // {
    //     $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    // }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($pass)
    {
        $this->password = Yii::$app->security->generatePasswordHash($pass);
    }

}