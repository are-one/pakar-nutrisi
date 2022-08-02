<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property int $id_admin
 * @property string $nama_admin
 * @property string $username
 * @property string $password
 */
class AhliGizi extends \yii\db\ActiveRecord implements IdentityInterface
{
   /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ahli_gizi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis_kelamin'], 'string'],
            [['username'], 'string', 'max' => 45],
            [['password', 'alamat', 'foto'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ahli' => 'Id Ahli',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'jenis_kelamin' => 'Jenis Kelamin',
            'foto' => 'Foto',
        ];
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id_ahli' => $id]);
    }


    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented');
    }

    public function getAuthKey()
    {
        // throw new NotSupportedException('"getAuthKey" is not implemented');
        return Yii::$app->params['authKeyAhliGizi'];
    }

    public function validateAuthKey($authKey)
    {
        return Yii::$app->params['authKeyAhliGizi'] === $authKey;
    }

     /**
    * Gets query for [[Pasiens]].
    *
    * @return \yii\db\ActiveQuery
    */
   public function getPasiens(){
        return $this->hasMany(Pasien::className(), ['ahli_gizi_id' => 'id_ahli']);
   }
}