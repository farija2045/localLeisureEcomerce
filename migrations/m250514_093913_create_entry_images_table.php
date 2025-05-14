<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%entry_images}}` in the `post_db` database.
 */
class m250514_093913_create_entry_images_table extends Migration
{
    /**
     * Initializes the migration to use the `postDb` database connection.
     */
    public function init()
    {
        $this->db = 'postDb'; // Use the postDb connection
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%entry_images}}', [
            'image_id' => $this->primaryKey(), // Primary key
            'entry_id' => $this->integer()->notNull(), // Foreign key referencing admin_entries
            'image_path' => $this->string(255)->notNull(), // Path to the image file
            'image_url' => $this->string(255)->null(), // Optional URL for the image
        ]);

        // Add a foreign key constraint to link entry_images to admin_entries
        $this->addForeignKey(
            'fk-entry_images-entry_id', // Name of the foreign key
            '{{%entry_images}}', // Table with the foreign key
            'entry_id', // Column in entry_images
            '{{%admin_entries}}', // Referenced table
            'id', // Referenced column in admin_entries
            'CASCADE', // On delete
            'CASCADE' // On update
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop the foreign key first
        $this->dropForeignKey('fk-entry_images-entry_id', '{{%entry_images}}');

        // Drop the table
        $this->dropTable('{{%entry_images}}');
    }
}
