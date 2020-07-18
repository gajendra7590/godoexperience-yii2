 <?php

use yii\db\Migration;

class m200131_072121_users_list_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {             
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(50)->defaultValue(null),
            'middle_name' => $this->string(50)->defaultValue(null),  
            'last_name' => $this->string(50)->defaultValue(null),  
            'bussiness_name' => $this->string(50)->defaultValue(null),             
            'email' => $this->string(100)->notNull()->unique(),
            'username' => $this->string(50)->notNull()->unique(),            
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(100)->notNull(),
            'password_reset_token' => $this->string(100)->unique(),   
            'verification_token' => $this->string(100)->defaultValue(null),
            'profile_photo' => $this->string(100)->defaultValue(null),
            'phone_home' => $this->string(12)->defaultValue(null),
            'phone_office' => $this->string(12)->defaultValue(null),
            'gender' => $this->string(6)->defaultValue(null),
            'dob' => $this->date()->defaultValue(null),
            'city' => $this->string(50)->defaultValue(null),
            'state' => $this->string(50)->defaultValue(null),
            'country' => $this->string(50)->defaultValue(null),
            'zip' => $this->string(8)->defaultValue(null),
            'ip_address' => $this->string(15)->defaultValue(null),
            'social_google_uid' => $this->string(50)->defaultValue(NULL),            
            'social_google_picture' => $this->string(256)->defaultValue(NULL), 
            'social_google_last_login' => $this->dateTime()->defaultValue(NULL),
            'social_fb_uid' => $this->string(50)->defaultValue(NULL),            
            'social_fb_picture' => $this->string(256)->defaultValue(NULL),  
            'social_fb_last_login' => $this->dateTime()->defaultValue(NULL),
            'social_twitter_uid' => $this->string(50)->defaultValue(NULL),            
            'social_twitter_picture' => $this->string(256)->defaultValue(NULL), 
            'social_twitter_last_login' => $this->dateTime()->defaultValue(NULL), 
            'social_linkedin_uid' => $this->string(50)->defaultValue(NULL),            
            'social_linkedin_picture' => $this->string(256)->defaultValue(NULL), 
            'social_linkedin_last_login' => $this->dateTime()->defaultValue(NULL),
            'social_github_uid' => $this->string(50)->defaultValue(NULL),            
            'social_github_picture' => $this->string(256)->defaultValue(NULL),   
            'social_github_last_login' => $this->dateTime()->defaultValue(NULL),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'role_id' => $this->integer(11)->notNull()->defaultValue(2),
            'last_login' => $this->dateTime()->defaultValue(null),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);

        $this->addForeignKey('fk_user_role_id', 'user', 'role_id', 'user_roles',  'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_user_role_id',
            'user'
        );

        $this->dropTable('{{%user}}');
    }
}

