<?php


/** @var yii\web\View $this */
/** @var app\models\AdminEntry[] $entries */

$this->title = 'Admin Entries';
?>


<div class="admin-entries-container">
    <?php if (!empty($entries)): ?>
        <div class="entries-container">
            <?php foreach ($entries as $entry): ?>
                <a href="<?= htmlspecialchars($entry->image_url) ?>" target="_blank" class="entry-card">
                    <div class="entry-image">
                        <img src="<?= htmlspecialchars($entry->image_path) ?>" alt="Entry Image">
                    </div>
                    <div class="entry-details">
                        <h3><?= htmlspecialchars($entry->title) ?></h3>
                        <p><strong>Description:</strong> <?= htmlspecialchars($entry->description) ?></p>
                        <p><strong>Type:</strong> <?= htmlspecialchars($entry->type) ?></p>
                        <p><strong>Date:</strong> <?= htmlspecialchars($entry->date) ?></p>
                        <p><strong>Location:</strong> <?= htmlspecialchars($entry->location) ?></p>
                        <p><strong>Uploaded by:</strong> <?= htmlspecialchars($entry->user->username) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No entries found.</p>
    <?php endif; ?>
</div>