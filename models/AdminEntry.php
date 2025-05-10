<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_entries".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $date
 * @property string|null $location
 * @property string|null $image
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
            [['location', 'image'], 'default', 'value' => null],
            [['title', 'description', 'type', 'date'], 'required'],
            [['description', 'type'], 'string'],
            [['date'], 'safe'],
            [['title', 'location', 'image'], 'string', 'max' => 255],
            ['type', 'in', 'range' => array_keys(self::optsType())],
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
            'image' => 'Image',
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
}
