<?php
namespace app\models;

use yii\base\Model;
use yii\base\InvalidArgumentException;
use app\models\User;

class ResetPasswordForm extends Model
{
    public $password;
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config
     * @throws InvalidArgumentException if token is empty or invalid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * @return array validation rules
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Resets password.
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->password_reset_token = null; // Invalidate the token after successful reset
        return $user->save(false);
    }
}
