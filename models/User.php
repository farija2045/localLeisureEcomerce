<?php
namespace app\models;

use app\models\Entry;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user'; 
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // Not used
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    // Optional: define relation to images
    public function getImages()
    {
        return $this->hasMany(Image::class, ['user_id' => 'id']);
    }

    // Optional: validation rules
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'role'], 'required'],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
            ['role', 'in', 'range' => ['admin', 'user']],
        ];
    }
    public function getEntries()
{
    return $this->hasMany(\app\models\Entry::class, ['user_id' => 'id']);
}

}
