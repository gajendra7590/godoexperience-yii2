<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ManageUser;

/**
 * ManageUserSearch represents the model behind the search form of `common\models\ManageUser`.
 */
class ManageUserSearch extends ManageUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'role_id'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'bussiness_name', 'email', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'verification_token', 'profile_photo', 'phone_home', 'phone_office', 'gender', 'dob', 'city', 'state', 'country', 'zip', 'ip_address', 'social_google_uid', 'social_google_picture', 'social_google_last_login', 'social_fb_uid', 'social_fb_picture', 'social_fb_last_login', 'social_twitter_uid', 'social_twitter_picture', 'social_twitter_last_login', 'social_linkedin_uid', 'social_linkedin_picture', 'social_linkedin_last_login', 'social_github_uid', 'social_github_picture', 'social_github_last_login', 'last_login', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$role = null)
    {
        $query = ManageUser::find();

        // add conditions that should always apply here



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->where('status!=2');
        
        //Custom Search
        if($role!=null){
            $query->andWhere('role_id='.$role);
        }



        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dob' => $this->dob,
            'social_google_last_login' => $this->social_google_last_login,
            'social_fb_last_login' => $this->social_fb_last_login,
            'social_twitter_last_login' => $this->social_twitter_last_login,
            'social_linkedin_last_login' => $this->social_linkedin_last_login,
            'social_github_last_login' => $this->social_github_last_login,
            'status' => $this->status,
            'role_id' => $this->role_id,
            'last_login' => $this->last_login,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'bussiness_name', $this->bussiness_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'profile_photo', $this->profile_photo])
            ->andFilterWhere(['like', 'phone_home', $this->phone_home])
            ->andFilterWhere(['like', 'phone_office', $this->phone_office])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'social_google_uid', $this->social_google_uid])
            ->andFilterWhere(['like', 'social_google_picture', $this->social_google_picture])
            ->andFilterWhere(['like', 'social_fb_uid', $this->social_fb_uid])
            ->andFilterWhere(['like', 'social_fb_picture', $this->social_fb_picture])
            ->andFilterWhere(['like', 'social_twitter_uid', $this->social_twitter_uid])
            ->andFilterWhere(['like', 'social_twitter_picture', $this->social_twitter_picture])
            ->andFilterWhere(['like', 'social_linkedin_uid', $this->social_linkedin_uid])
            ->andFilterWhere(['like', 'social_linkedin_picture', $this->social_linkedin_picture])
            ->andFilterWhere(['like', 'social_github_uid', $this->social_github_uid])
            ->andFilterWhere(['like', 'social_github_picture', $this->social_github_picture]);

//             echo $query->createCommand()->getRawSql();die;


        return $dataProvider;
    }
}
