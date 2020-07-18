<?php

use yii\db\Migration;

/**
 * Class m200207_093552_favourites_experiences
 */
class m200207_093552_favourites_experiences extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('fav_experiences', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'experience_id' => $this->integer(11)->notNull(),   
            'created_at' => $this->dateTime()->defaultValue(NULL),
            'updated_at' => $this->dateTime()->defaultValue(NULL),
        ]); 

        $this->addForeignKey('fk-fav_experiences-exp_id', 'fav_experiences', 'experience_id', 'experiences',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-fav_experiences-user_id', 'fav_experiences', 'user_id', 'user',  'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-fav_experiences-exp_id',
            'fav_experiences' 
        );

        $this->dropForeignKey(
            'fk-fav_experiences-user_id',
            'fav_experiences' 
        );


        $this->dropTable('fav_experiences');
    } 

}
