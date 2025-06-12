<?php

namespace app\models;

use yii\db\ActiveRecord;

class ContactMessage extends ActiveRecord
{
    public static function tableName()
    {
        return 'contact_message';
    }

    public function rules()
    {
        return [
            [['entry_id', 'sender_name', 'sender_email', 'message'], 'required'],
            [['entry_id'], 'integer'],
            [['message'], 'string'],
            [['sender_email'], 'email'],
            [['sender_name', 'sender_email'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entry_id' => 'Leisure Entry',
            'sender_name' => 'Your Name',
            'sender_email' => 'Your Email',
            'message' => 'Message to Seller',
        ];
    }

    public function getEntry()
    {
        return $this->hasOne(AdminEntries::class, ['id' => 'entry_id']);
    }
}
