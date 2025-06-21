<?php

/** @var yii\web\View $this */
/** @var app\models\Promotion|null $promotion */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'LOCAL LEISURE FINDER SYSTEM';
?>
<?php if (!empty($promotions)): ?>
    <?php foreach ($promotions as $promotion): ?>
        <div class="alert alert-danger text-center fw-bold mb-4" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#promotionModal<?= $promotion->id ?>">
             <strong><?= Html::encode($promotion->title) ?></strong>:
            <?= Html::encode($promotion->description) ?>
            <?php if ($promotion->discount_percent > 0): ?>
                <span class="badge bg-warning text-dark"><?= Html::encode($promotion->discount_percent) ?>% OFF</span>
            <?php endif; ?>
            <span class="ms-2 text-primary" style="text-decoration:underline;">View Details</span>
        </div>

        <!-- Promotion Modal -->
        <div class="modal fade" id="promotionModal<?= $promotion->id ?>" tabindex="-1" aria-labelledby="promotionModalLabel<?= $promotion->id ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="promotionModalLabel<?= $promotion->id ?>"><?= Html::encode($promotion->title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p><?= Html::encode($promotion->description) ?></p>
                <?php if ($promotion->discount_percent > 0): ?>
                    <p><strong>Discount:</strong> <?= Html::encode($promotion->discount_percent) ?>%</p>
                <?php endif; ?>
                <p><strong>Valid:</strong> <?= Html::encode($promotion->start_date) ?> to <?= Html::encode($promotion->end_date) ?></p>
              </div>
            </div>
          </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="leisure-index">

    <div class="jumbotron text-center bg-primary text-white mt-5 mb-5 p-5 rounded">
        <h1 class="display-4">Welcome to the Local Leisure Finder System!</h1>
        <p class="lead">Discover exciting leisure spots and activities near you!</p>
        <p><a class="btn btn-lg btn-light" href="https://www.google.com/maps/search/leisure+areas+near+me" target="_blank">Find Leisure Areas</a></p>
    </div>

    <div>
        <h2 class="text-center">Uploaded Entries</h2>
        <div class="row">
            <?php foreach (\app\models\AdminEntry::find()->all() as $entry): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card hover-effect">
                        <a href="<?= Html::encode($entry->image_url) ?>" target="_blank">
                            <img src="<?= Yii::getAlias('@web') . '/' . $entry->image_path ?>" class="card-img-top" alt="<?= $entry->title ?>" style="max-height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($entry->title) ?></h5>
                            <p class="card-text"><?= Html::encode($entry->description) ?></p>

                            <?php if (!empty($entry->image_url)): ?>
                                <p>
                                    <a href="<?= Html::encode($entry->image_url) ?>" target="_blank" class="btn btn-secondary">Visit Link</a>
                                </p>
                            <?php endif; ?>

                            <!-- Show Price Toast Button -->
                            <button type="button" class="btn btn-danger" onclick="showPriceToast<?= $entry->id ?>()">
                                <i class="bi bi-heart-fill"></i> Show Price
                            </button>

                            <!-- Toast for Price -->
                            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
                                <div id="priceToast<?= $entry->id ?>" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        <div class="toast-body">
                                            <strong>Price:</strong> <?= Yii::$app->formatter->asCurrency($entry->price) ?>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function showPriceToast<?= $entry->id ?>() {
                                var toastEl = document.getElementById('priceToast<?= $entry->id ?>');
                                var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                                toast.show();
                            }
                            </script>

                            <!-- Existing View Details button -->
                            <a href="<?= Url::to(['leisure/image', 'id' => $entry->id]) ?>" class="btn btn-primary">View Details</a>

                            <!-- New: Booking and Contact Seller Buttons -->
                            <div class="mt-2 d-flex justify-content-between">
                                <?= Html::a('Book Now', ['leisure/book', 'entry_id' => $entry->id], ['class' => 'btn btn-success']) ?>
                                <?= Html::a('Contact Seller', ['leisure/contact-seller', 'entry_id' => $entry->id], ['class' => 'btn btn-info']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
