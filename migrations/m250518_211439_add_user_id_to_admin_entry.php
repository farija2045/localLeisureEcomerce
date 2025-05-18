<?php

use yii\db\Migration;

class m250518_211439_add_user_id_to_admin_entry extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add user_id column to admin_entry table
        $this->addColumn('admin_entries', 'user_id', $this->integer()->notNull());

        // Create index for user_id
        $this->createIndex(
            'idx-admin_entry-user_id',
            'admin_entries',
            'user_id'
        );

        // Add foreign key for user_id
        $this->addForeignKey(
            'fk-admin_entry-user_id',
            'admin_entries',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key
        $this->dropForeignKey(
            'fk-admin_entry-user_id',
            'admin_entries'
        );

        // Drop index
        $this->dropIndex(
            'idx-admin_entry-user_id',
            'admin_entries'
        );

        // Drop user_id column
        $this->dropColumn('admin_entries', 'user_id');
    }
}
