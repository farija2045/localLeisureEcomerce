<?php
//use Yii;
/** @var yii\web\View $this */
/** @var app\models\User $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['leisure/reset-password', 'token' => $user->password_reset_token]);
?>
<p>Hello <?= htmlspecialchars($user->username) ?>,</p>

<p>Click the link below to reset your password:</p>

<p><a href="<?= $resetLink ?>"><?= $resetLink ?></a></p>
