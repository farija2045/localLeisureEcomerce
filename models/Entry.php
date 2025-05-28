<?php

namespace app\models;

use app\models\EntryImages;
use Yii;
use yii\db\ActiveRecord;

class Entry extends ActiveRecord
{
    public static function tableName()
    {
        return 'admin_entries'; // Hakikisha hili ni jina la meza yako ya entries
    }

    public function rules()
    {
        return [
            [['user_id', 'title', 'description'], 'required'],
            [['user_id'], 'integer'],
            [['title', 'description'], 'string'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getEntryImages()
    {
        return $this->hasMany(EntryImages::class, ['entry_id' => 'id']);
    }
    
}
