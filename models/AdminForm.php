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
    public $imageFile;
    public $imagePath;
    public $imageUrl;

    public function rules()
    {
        return [
            [['title', 'description', 'type', 'date'], 'required'],
            [['description'], 'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['title', 'type', 'location'], 'string', 'max' => 255],
            [['imageFile'], 'image', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2],
            [['imageUrl'], 'url'],
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            // Create uploads directory if not exists
            $uploadDir = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'uploads';
            
            }

            // Handle file upload
            if ($this->imageFile instanceof UploadedFile) {
                $uniqueName = uniqid('img_') . '.' . $this->imageFile->extension;
                $relativePath = 'uploads/' . DIRECTORY_SEPARATOR . $uniqueName;
                $fullPath = $uploadDir . DIRECTORY_SEPARATOR . $uniqueName;

                if ($this->imageFile->saveAs($fullPath)) {
                    $this->imagePath = str_replace('\\', '/', $relativePath);
                    Yii::$app->session->setFlash('success', 'File uploaded successfully.');
                } else {
                    Yii::$app->session->setFlash('error', 'File upload failed!');
                    return false;
                }
            }

            // Insert into DB
            Yii::$app->db->createCommand()->insert('admin_entries', [
                'title' => $this->title,
                'description' => $this->description,
                'type' => $this->type,
                'date' => $this->date,
                'location' => $this->location,
                'image_path' => $this->imagePath ?? null,
                'image_url' => $this->imageUrl ?? null,
            ])->execute();

            return true;
        }

    }

