<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::getAlias('@web/css/custom.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top px-3'],
        'brandOptions' => [
            'class' => 'fw-bold fs-4',
            'style' => 'color:#6C63FF !important; letter-spacing:1px;'
        ],
    ]);

    $menuItems = [];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/leisure/login'], 'linkOptions' => ['class' => 'fw-semibold', 'style' => 'color:#6C63FF !important;']];
    } else {
        // If admin, add admin navigation links
        if (Yii::$app->user->identity->role === 'admin') {
            $menuItems[] = ['label' => 'Admin Dashboard', 'url' => ['/admin/index'], 'linkOptions' => ['class' => 'fw-semibold', 'style' => 'color:#6C63FF !important;']];
            $menuItems[] = ['label' => 'Bookings', 'url' => ['/admin/bookings'], 'linkOptions' => ['class' => 'fw-semibold', 'style' => 'color:#6C63FF !important;']];
            $menuItems[] = ['label' => 'Promotions', 'url' => ['/admin/promotions/'], 'linkOptions' => ['class' => 'fw-semibold', 'style' => 'color:#6C63FF !important;']];
            $menuItems[] = ['label' => 'Messages', 'url' => ['/admin/contact-messages'], 'linkOptions' => ['class' => 'fw-semibold', 'style' => 'color:#6C63FF !important;']];
        }

        // Logout button
        $menuItems[] = '<li class="nav-item">'
            . Html::beginForm(['/leisure/logout'], 'post', ['class' => 'd-inline'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'nav-link btn btn-link logout fw-semibold', 'style' => 'color:#6C63FF !important; padding: 0;']
            )
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto align-items-center'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);

    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="main-content container py-4">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Powered By Ecommerce <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
