<?php
use yii\helpers\Url;

/** @var app\models\User $user */

$resetLink = Url::to(['leisure/reset-password', 'token' => $user->password_reset_token], true);
?>

Hello <?= $user->username ?>,

You requested a password reset for your account at <?= Yii::$app->name ?>.

Follow the link below to reset your password:

<?= $resetLink ?>


If you did not request this, please ignore this email.
