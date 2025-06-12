<?php
namespace app\models;

use yii\db\ActiveRecord;

class Booking extends ActiveRecord
{
    public static function tableName() {
        return 'booking';
    }

    public function rules() {
        return [
           [['full_name', 'email', 'phone', 'preferred_date','status', 'notes'], 'safe'],
        [['user_id', 'entry_id'], 'integer'],
        [['status'], 'string', 'max' => 50],
        [['preferred_date'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }
    public function getUser()
{
    return $this->hasOne(User::class, ['id' => 'user_id']);
}

    public function getEntry() {
        return $this->hasOne(AdminEntry::class, ['id' => 'entry_id']);
    }
}
