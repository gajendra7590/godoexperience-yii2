<?php

use yii\db\Migration;

/**
 * Class m200207_093604_favourites_categories
 */
class m200207_093604_favourites_categories extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('fav_categories', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'categories_id' => $this->integer(11)->notNull(),   
            'created_at' => $this->dateTime()->defaultValue(NULL),
            'updated_at' => $this->dateTime()->defaultValue(NULL),
        ]); 

        $this->addForeignKey('fk_fav_categories_categories_id', 'fav_categories', 'categories_id', 'experience_categories',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_fav_categories_user_id', 'fav_categories', 'user_id', 'user',  'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_fav_categories_categories_id',
            'fav_categories'
        );

        $this->dropForeignKey(
            'fk_fav_categories_user_id',
            'fav_categories'
        ); 
        $this->dropTable('fav_categories');

    } 

}
