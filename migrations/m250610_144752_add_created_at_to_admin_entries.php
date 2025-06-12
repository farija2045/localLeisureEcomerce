<?php

use yii\db\Migration;

class m250610_144752_add_created_at_to_admin_entries extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250610_144752_add_created_at_to_admin_entries cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250610_144752_add_created_at_to_admin_entries cannot be reverted.\n";

        return false;
    }
    */
    public function up()
{
    $this->addColumn('admin_entries', 'created_at', $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'));
}

public function down()
{
    $this->dropColumn('admin_entries', 'created_at');
}
}