<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\User $user */

$resetLink = Url::to(['leisure/reset-password', 'token' => $user->password_reset_token], true);
?>

<p>Hello <?= Html::encode($user->username) ?>,</p>

<p>You requested a password reset for your account at <?= Html::encode(Yii::$app->name) ?>.</p>

<p>Click the link below to reset your password:</p>

<p><?= Html::a('Reset your password', $resetLink) ?></p>

<p>If you did not make this request, just ignore this email.</p>
