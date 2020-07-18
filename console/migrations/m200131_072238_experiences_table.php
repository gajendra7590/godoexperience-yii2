<?php

use yii\db\Migration;

/**
 * Class m200131_072238_experiences_table
 */
class m200131_072238_experiences_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('experiences', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),            
            'title' => $this->text()->defaultValue(NULL),
            'sub_title' => $this->text()->defaultValue(NULL),
            'description' => $this->text()->defaultValue(NULL),   
            'slug' => $this->string(100)->defaultValue(NULL),   
            'experiences_image_url' => $this->string()->defaultValue(NULL),  
            'experiences_video_url' => $this->string()->defaultValue(NULL),    
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'featured' => $this->smallInteger(1)->defaultValue(0),
            'featured_date' => $this->dateTime()->defaultValue(NULL),
            'created_at' => $this->dateTime()->defaultValue(NULL),
            'updated_at' => $this->dateTime()->defaultValue(NULL),
        ]);

        $this->addForeignKey('fk_experiences_category_id', 'experiences', 'category_id', 'experience_categories',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_experiences_user_id', 'experiences', 'user_id', 'user',  'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_experiences_category_id',
            'experiences'
        );

        $this->dropForeignKey(
            'fk_experiences_category_id',
            'experiences'
        );


        $this->dropTable('experiences');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200131_072238_experiences_table cannot be reverted.\n";

        return false;
    }
    */
}
