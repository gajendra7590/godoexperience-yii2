<?php

use yii\db\Migration;

/**
 * Class m200210_100008_company_info_table
 */
class m200210_100008_company_info_table extends Migration
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
        echo "m200210_100008_company_info_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200210_100008_company_info_table cannot be reverted.\n";

        return false;
    }
    */
}
