<?php

use yii\db\Migration;

/**
 * Class m200211_075413_insert_default_user
 */
class m200211_075413_insert_default_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    { 
        $this->batchInsert(
            'user',
            ['first_name','last_name', 'username','email','auth_key','password_hash','password_reset_token','status','role_id','created_at','updated_at'], 
            [
             [   'Super',
                 'Admin',
                 'super admin',
                 'admin@godoexperiences.com',
                 \Yii::$app->security->generateRandomString(),
                 \Yii::$app->security->generatePasswordHash('123456'),
                 \Yii::$app->security->generateRandomString(),
                 1,
                 1,
                 date('Y-m-d H:i:s'),
                 date('Y-m-d H:i:s')
             ],
             [  
                 'Vendor',
                 'Vendor',
                 'vendor',
                 'vendor@godoexperiences.com',
                 \Yii::$app->security->generateRandomString(),
                 \Yii::$app->security->generatePasswordHash('123456'),
                 \Yii::$app->security->generateRandomString(),
                 1,
                 1,
                 date('Y-m-d H:i:s'),
                 date('Y-m-d H:i:s')
             ],
             [   'Client',
                 'Client',
                 'client',
                 'client@godoexperiences.com',
                 \Yii::$app->security->generateRandomString(),
                 \Yii::$app->security->generatePasswordHash('123456'),
                 \Yii::$app->security->generateRandomString(),
                 1,
                 1,
                 date('Y-m-d H:i:s'),
                 date('Y-m-d H:i:s')
             ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    { 

    } 
}
