<?php

use yii\db\Migration;

/**
 * Class m200131_072221_exp_categories_table
 */
class m200131_072221_exp_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('experience_categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'title' => $this->string(256)->notNull(),
            'description' => $this->text()->defaultValue(NULL),     
            'slug' => $this->string(100)->defaultValue(NULL), 
            'category_image_url' => $this->string()->defaultValue(NULL),  
            'category_video_url' => $this->string()->defaultValue(NULL),    
            'parent_id' => $this->integer()->defaultValue(NULL),  
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'featured' => $this->smallInteger(1)->defaultValue(0),
            'featured_date' => $this->dateTime()->defaultValue(NULL),
            'created_at' => $this->dateTime()->defaultValue(NULL),
            'updated_at' => $this->dateTime()->defaultValue(NULL),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('experience_categories');
    } 
}
