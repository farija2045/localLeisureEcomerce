<?php

namespace app\models;

use yii\db\ActiveRecord;

class Promotion extends ActiveRecord
{
    public static function tableName()
    {
        return 'promotion';
    }

    public function rules()
    {
        return [
            [['entry_id', 'title', 'description', 'start_date', 'end_date'], 'required'],
            [['entry_id'], 'integer'],
            [['description'], 'string'],
            [['start_date', 'end_date'], 'date', 'format' => 'php:Y-m-d'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entry_id' => 'Leisure Entry',
            'title' => 'Promotion Title',
            'description' => 'Description',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    public function getEntry()
    {
        return $this->hasOne(AdminEntries::class, ['id' => 'entry_id']);
    }
}
