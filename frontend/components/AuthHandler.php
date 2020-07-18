<?php
namespace frontend\components;

use common\models\User;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    } 
    

    public function handle()
    {
        $attributes = $this->client->getUserAttributes();  
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        
        $get_source = $this->get_source_array($this->client->getId(),$id);  
        $auth_user = User::find()->where($get_source)->one(); 
        if (Yii::$app->user->isGuest) {
            if ($auth_user) {  // login if existing user 
                if($auth_user->role_id == '3'){ //Check if email is exist as admin/vendor 
                    $user =  $this->get_info_update_array($this->client->getId(),$attributes,$auth_user);
                    if ($user->save()) {  
                        Yii::$app->user->login($user, Yii::$app->params['user.passwordResetTokenExpire']); 
                        Yii::$app->session->setFlash('success', "Welcome back,".$user['first_name'].' '.$user['last_name']);
                        Yii::$app->response->redirect(['/']);
                    } else {
                        Yii::$app->session->setFlash('error', "Error in login : ".json_encode($user->getErrors()) );
                        Yii::$app->response->redirect(['/']); 
                    }   
                }else{
                    Yii::$app->session->setFlash('error', "Your email is not able to login as a client");
                    Yii::$app->response->redirect(['/']);
                }                  
            } else { // signup if new user 
                    $auth_user_exist = User::find()->where(['email'=>$email])->one();
                    if($auth_user_exist){
                        if($auth_user_exist->role_id == '3'){ //Check if email is exist as admin/vendor 
                            $user =  $this->get_info_update_array2($this->client->getId(),$attributes,$auth_user_exist);   
                            if ($user->save()) {  
                                Yii::$app->user->login($user, Yii::$app->params['user.passwordResetTokenExpire']); 
                                Yii::$app->session->setFlash('success', "Welcome back,".$user['first_name'].' '.$user['last_name']);
                                Yii::$app->response->redirect(['/']);
                            } else {
                                Yii::$app->session->setFlash('error', "Error in login : ".json_encode($user->getErrors()) );
                                Yii::$app->response->redirect(['/']); 
                            }   
                        }else{ 
                            Yii::$app->session->setFlash('error', "Sorry your are not able to logged in.");
                            Yii::$app->response->redirect(['/']); 
                        } 

                    }else{ //If user not exist with Email ID
                        $user_insert =  $this->get_info_insert_array($this->client->getId(),$attributes);
                        $user = new User($user_insert);
                        $user->generateAuthKey();
                        $user->generatePasswordResetToken(); 
                        $transaction = User::getDb()->beginTransaction(); 
                        if ($user->save()) {    
                                $transaction->commit();
                                Yii::$app->user->login($user, Yii::$app->params['user.passwordResetTokenExpire']); 
                                Yii::$app->session->setFlash('success', "Welcome to GoDo Experiences");
                                Yii::$app->response->redirect(['/']);
                        } else {
                            Yii::$app->session->setFlash('error', "Error in login : ".json_encode($user->getErrors()) );
                            Yii::$app->response->redirect(['/']); 
                        } 

                    }                    
            }
        }else{
            Yii::$app->session->setFlash('error', "You are already logged in");
            Yii::$app->response->redirect(['/']); 
        }  
    } 


    private function get_source_array($source,$source_id){
        switch ($source) {
            case "google":
                return ['social_google_uid' => $source_id];
                break;
            case "facebook":
                return ['social_fb_uid' => $source_id];
                break;
            case "twitter":
                return ['social_twitter_uid' => $source_id];
                break;
           case "linkedin":
                return ['social_linkedin_uid' => $source_id];
                break;    
           case "github":
                return ['social_github_uid' => $source_id];
                break;    
            default:
                // Do more here;
        }
    }
    
    //function for new user if not exist
    private function get_info_insert_array($source,$attributes){
        switch ($source) {
            case "google":
                return [
                    'first_name' => ArrayHelper::getValue($attributes, 'given_name'),
                    'last_name' => ArrayHelper::getValue($attributes, 'family_name'),
                    'email' => ArrayHelper::getValue($attributes, 'email'),
                    'username' => rand(111111111111,9999999999999),
                    'password_hash' => Yii::$app->security->generatePasswordHash(123456),
                    'auth_key' => Yii::$app->security->generateRandomString(),
                    'verification_token' => Yii::$app->security->generateRandomString(),
                    'password_reset_token' => Yii::$app->security->generateRandomString(),
                    'status' => '1',
                    'role_id'=>'3',
                    'social_google_uid' => ArrayHelper::getValue($attributes, 'id'),
                    'social_google_picture' => ArrayHelper::getValue($attributes, 'picture'),
                    'social_google_last_login' => date('Y-m-d H:i:s'),
                    // 'logged_with' => 'google',                    
                    'last_login' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                break;
            case "facebook":
                return [];
                break;
            case "twitter":
                return [];
                break;
           case "linkedin":
                return [];
                break;    
           case "github":
                return [
                    'first_name' => ArrayHelper::getValue($attributes, 'name'), 
                    'email' => ArrayHelper::getValue($attributes, 'email'),
                    'username' => rand(111111111111,9999999999999),
                    'password_hash' => Yii::$app->security->generatePasswordHash(123456),
                    'auth_key' => Yii::$app->security->generateRandomString(),
                    'verification_token' => Yii::$app->security->generateRandomString(),
                    'password_reset_token' => Yii::$app->security->generateRandomString(),
                    'status' => '1',
                    'role_id'=>'3',
                    'social_github_uid' => ArrayHelper::getValue($attributes, 'id'),
                    'social_github_picture' => ArrayHelper::getValue($attributes, 'avatar_url'),
                    'social_github_last_login' => date('Y-m-d H:i:s'),
                    // 'logged_with' => 'github',                    
                    'last_login' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                break;    
            default:
                // Do more here;
        }
    }
    
    //Get Update Array if user exist with social account
    private function get_info_update_array($source,$attributes,$user_instance){
        switch ($source) {
            case "google": 
                $user_instance->social_google_picture = ArrayHelper::getValue($attributes, 'picture');
                $user_instance->social_google_last_login = date('Y-m-d H:i:s');
                $user_instance->last_login = date('Y-m-d H:i:s'); 
                // $user_instance->logged_with = 'google'; 
                return $user_instance;
                break;
            case "facebook":
                return [];
                break;
            case "twitter":
                return [];
                break;
           case "linkedin":
                return [];
                break;    
           case "github":
                $user_instance->social_github_picture = ArrayHelper::getValue($attributes, 'avatar_url');
                $user_instance->social_github_last_login = date('Y-m-d H:i:s');
                $user_instance->last_login = date('Y-m-d H:i:s'); 
                // $user_instance->logged_with = 'github'; 
                return $user_instance;
                break;    
            default:
                // Do more here;
        }
    }


    //Get Update Array if user exist with social account
    private function get_info_update_array2($source,$attributes,$user_instance){
        switch ($source) {
            case "google": 
                $user_instance->social_google_uid = ArrayHelper::getValue($attributes, 'id');     
                $user_instance->social_google_picture = ArrayHelper::getValue($attributes, 'picture');                           
                $user_instance->social_google_picture = ArrayHelper::getValue($attributes, 'picture');
                $user_instance->social_google_last_login = date('Y-m-d H:i:s');
                $user_instance->last_login = date('Y-m-d H:i:s'); 
                // $user_instance->logged_with = 'google'; 
                return $user_instance;
                break;
            case "facebook":
                return [];
                break;
            case "twitter":
                return [];
                break;
           case "linkedin":
                return [];
                break;    
           case "github":
                $user_instance->social_github_uid = ArrayHelper::getValue($attributes, 'id'); 
                $user_instance->social_github_picture = ArrayHelper::getValue($attributes, 'avatar_url');
                $user_instance->social_github_last_login = date('Y-m-d H:i:s');
                $user_instance->last_login = date('Y-m-d H:i:s'); 
                // $user_instance->logged_with = 'github'; 
                return $user_instance;
                break;    
            default:
                // Do more here;
        }
    }
    
}