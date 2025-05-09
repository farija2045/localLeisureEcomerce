<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class AdminForm extends Model
{
    public $title;
    public $description;
    public $type;
    public $date;
    public $location;
    public $imageFile; // For file uploads
    public $imageUrl;  // For image URLs

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'type', 'date'], 'required'],
            [['description'], 'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['title', 'type', 'location'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2], // 2MB max
            [['imageUrl'], 'url'], // Validate the URL format
        ];
    }

    /**
     * Save the form data to the database and handle the image upload or URL.
     */
    public function save()
    {
        if ($this->validate()) {
            $filePath = null;

            // Handle file upload
            if ($this->imageFile) {
                $filePath = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs($filePath);
            }

            // Use the URL if provided
            if (!empty($this->imageUrl)) {
                $filePath = $this->imageUrl; // URL takes precedence over file upload
            }

            // Save the data to the database
            Yii::$app->db->createCommand()->insert('admin_entries', [
                'title' => $this->title,
                'description' => $this->description,
                'type' => $this->type,
                'date' => $this->date,
                'location' => $this->location,
                'image' => $filePath, // Store either the file path or the URL
            ])->execute();

            return true;
        }

        return false;
    }
}