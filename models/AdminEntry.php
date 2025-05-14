<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "admin_entries".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $date
 * @property string|null $location
 * @property string|null $image_path
 * @property string|null $image_url
 * @property UploadedFile[] $images Array to store multiple uploaded files
 * @property EntryImages[] $relatedImages Relation to the entry_images table
 */
class AdminEntry extends \yii\db\ActiveRecord
{
    /**
     * ENUM field values
     */
    const TYPE_UPPER = 'upper';
    const TYPE_MIDDLE = 'middle';
    const TYPE_LOWER = 'lower';

    /**
     * @var UploadedFile[] Array to store multiple uploaded files
     */
    public $images;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_entries';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('postDb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location', 'image_path', 'image_url'], 'default', 'value' => null],
            [['title', 'description', 'type', 'date'], 'required'],
            [['description', 'type'], 'string'],
            [['date'], 'safe'],
            [['title', 'location', 'image_path', 'image_url'], 'string', 'max' => 255],
            ['type', 'in', 'range' => array_keys(self::optsType())],
            [['images'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10], // Allow up to 10 files
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'type' => 'Type',
            'date' => 'Date',
            'location' => 'Location',
            'image_path' => 'Image Path',
            'image_url' => 'Image URL',
            'images' => 'Images',
        ];
    }

    /**
     * column type ENUM value labels
     * @return string[]
     */
    public static function optsType()
    {
        return [
            self::TYPE_UPPER => 'upper',
            self::TYPE_MIDDLE => 'middle',
            self::TYPE_LOWER => 'lower',
        ];
    }

    /**
     * @return string
     */
    public function displayType()
    {
        return self::optsType()[$this->type];
    }

    /**
     * @return bool
     */
    public function isTypeUpper()
    {
        return $this->type === self::TYPE_UPPER;
    }

    public function setTypeToUpper()
    {
        $this->type = self::TYPE_UPPER;
    }

    /**
     * @return bool
     */
    public function isTypeMiddle()
    {
        return $this->type === self::TYPE_MIDDLE;
    }

    public function setTypeToMiddle()
    {
        $this->type = self::TYPE_MIDDLE;
    }

    /**
     * @return bool
     */
    public function isTypeLower()
    {
        return $this->type === self::TYPE_LOWER;
    }

    public function setTypeToLower()
    {
        $this->type = self::TYPE_LOWER;
    }

    /**
     * Relation to the entry_images table
     * @return \yii\db\ActiveQuery
     */
    public function getRelatedImages()
    {
        return $this->hasMany(EntryImages::class, ['entry_id' => 'id']);
    }
}
