<?php
/** @var string $content */
/** @var yii\mail\MessageInterface $message */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Yii::$app->name ?> Email</title>
</head>
<body>
    <?= $content ?>
</body>
</html>
