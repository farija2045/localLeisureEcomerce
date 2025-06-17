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
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>

    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/images/favcon.png') ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::getAlias('@web/css/custom.css') ?>" rel="stylesheet">
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css'); ?>

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

    $items = [];

    // Always show "About Us"
    $items[] = [
        'label' => 'About Us',
        'url' => ['/leisure/about-us'],
        'linkOptions' => ['class' => 'fw-semibold', 'style' => 'color:#6C63FF !important;']
    ];

    if (Yii::$app->user->isGuest) {
        $items[] = [
            'label' => 'Login/ Register',
            'url' => ['/leisure/login'],
            'linkOptions' => ['class' => 'fw-semibold', 'style' => 'color:#6C63FF !important;']
        ];
    } else {
        // Show Admin link only for admin users
        if (isset(Yii::$app->user->identity->isAdmin) && Yii::$app->user->identity->isAdmin) {
            $items[] = [
                'label' => 'Admin',
                'url' => ['/admin/index'],
                'linkOptions' => ['class' => 'fw-semibold', 'style' => 'color:#6C63FF !important;']
            ];
        }

        $items[] = '<li class="nav-item">'
            . Html::beginForm(['/leisure/logout'], 'post', ['class' => 'd-inline'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                [
                    'class' => 'nav-link logout fw-semibold',
                    'style' => 'color:#6C63FF !important; background:none; border:none; padding:0 1rem; cursor:pointer;'
                ]
            )
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto align-items-center'],
        'items' => $items,
    ]);

    NavBar::end();
    ?>
</header>

<!-- Navigation Buttons and Dropdown (appears on every page) -->
<div class="navigation-buttons mb-3" style="margin-top:70px;">
    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Go Back</button>
    <button type="button" class="btn btn-secondary" onclick="window.history.forward();">Go Forward</button>
    <select class="form-select d-inline-block w-auto" onchange="if(this.value) window.location.href=this.value;">
        <option value="">Select Page...</option>
        <option value="/site/index">Home</option>
        <option value="/leisure/about-us">About Us</option>
        <option value="/leisure/booking">Booking</option>
        <option value="/leisure/contact">Contact</option>
        <!-- Add more destinations as needed -->
    </select>
</div>

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
            <div class="col-md-6 text-center text-md-start">&copy; Powered By Ecomerce <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
