<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "entry_images".
 *
 * @property int $id
 * @property int $entry_id
 * @property string $image_path
 */
class EntryImages extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entry_images'; // Ensure this matches your database table name
    }

    // Use the default DB connection
    // Remove or update the getDb() method
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public function rules()
    {
        return [
            [['entry_id', 'image_path'], 'required'],
            [['entry_id'], 'integer'],
            [['image_path','image_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entry_id' => 'Entry ID',
            'image_path' => 'Image Path',
            'image_url' => 'Image URL',
        ];
    }
}