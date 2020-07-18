<?php

use yii\db\Migration;

/**
 * Class m200131_072107_user_roles_table
 */
class m200131_072107_user_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_roles', [
            'id' => $this->primaryKey(),
            'role_name' => $this->string(50)->notNull(),
            'role_display_name' => $this->string(50)->defaultValue(NULL),             
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->defaultValue(NULL),
            'updated_at' => $this->dateTime()->defaultValue(NULL),
        ]);


        $this->batchInsert(
            'user_roles',
            ['id', 'role_name', 'role_display_name','created_at','updated_at'], 
            [
             ['1','admin','Super Admin',date('Y-m-d H:i:s'),date('Y-m-d H:i:s')],
             ['2','vendor','Vendor',date('Y-m-d H:i:s'),date('Y-m-d H:i:s')],
             ['3','client','Client',date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]
            ]
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_roles');
    } 
}
