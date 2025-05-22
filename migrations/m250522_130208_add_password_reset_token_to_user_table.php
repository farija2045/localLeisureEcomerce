<?php

use yii\db\Migration;

class m250522_130208_add_password_reset_token_to_user_table extends Migration
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
        echo "m250522_130208_add_password_reset_token_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250522_130208_add_password_reset_token_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
