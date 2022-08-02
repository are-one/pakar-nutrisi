<?php

namespace app\models;

use app\models\Admin;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class UbahPassword extends Model
{
    public $password;
    public $password_lama;
    public $ulangi_password;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct()
    {
        $this->_user = Admin::findOne(Yii::$app->user->identity->id_admin);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'password_lama', 'ulangi_password'], 'required', 'message' => '{attribute} wajib diisi.'],
            ['password', 'string', 'min' => 6, 'tooShort' => '{attribute} minimal 6 karakter.'],
            // ['password_lama', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['ulangi_password', 'string', 'min' => 6, 'tooShort' => '{attribute} minimal 6 karakter.'],
            ['ulangi_password', 'compare', 'compareAttribute' => 'password', 'message' => '{attribute} tidak sama dengan {compareAttribute}']
        ];
    }

    public function attributeLabels()
    {
        return [
            'password_lama' => 'Password Lama',
            'ulangi_password' => 'Ulangi Password Baru',
            'password' => 'Password Baru',
        ];
    }

    public function vp()
    {
        if (!$this->_user->validatePassword($this->password_lama)) {
            $this->addError("password_lama", "Password lama salah");
            return false;
        }
        return true;
    }

    /**
     * Resets password.
     *
     * @return bool if password was change.
     */
    public function ubahPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);

        return $user->save(false);
    }
}
