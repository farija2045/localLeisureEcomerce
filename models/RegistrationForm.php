<?php

namespace app\models;

use yii\base\Model;
use app\models\User;

class RegistrationForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['username', 'string', 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['username', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username', 'message' => 'This username has already been taken.'],
            ['email', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email', 'message' => 'This email address has already been taken.'],
        ];
    }

    /**
     * Registers a new user
     *
     * @return bool whether the user was registered successfully
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->role = 'user'; // Default role for new users

        return $user->save();
    }
}