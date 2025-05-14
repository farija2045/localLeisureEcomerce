<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250418_113141_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->getTableSchema('{{%user}}', true) === null) {
            $this->createTable('{{%user}}', [
                'id' => $this->primaryKey(),
                // Add other columns as needed
            ]);
        } else {
            echo "Table 'user' already exists. Skipping creation.\n";
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if ($this->db->getTableSchema('{{%user}}', true) !== null) {
            $this->dropTable('{{%user}}');
        }
    }
}
