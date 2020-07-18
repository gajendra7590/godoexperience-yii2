<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExperiencesOrder;

/**
 * ExperiencesOrderSearch represents the model behind the search form of `common\models\ExperiencesOrder`.
 */
class ExperiencesOrderSearch extends ExperiencesOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'experience_id', 'user_id','payment_id','experience_price','experience_adons_price','net_pay','experience_avl_id','total_guest_adults','total_guest_children','total_guest_infants'], 'integer'],
            [['experience_adons_ids', 'experience_adons_detail', 'experience_start_date','experience_start_date','schedule_detail', 'created_at', 'updated_at'], 'safe'],
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
    public function search($params)
    {
        $query = ExperiencesOrder::find();
        $query->with(['experience' => function ($query) {
            $query->select('id, user_id,title,experiences_image_url,price,duration,duration_type,group_size,country,state,city');
        }]);

        $query->with(['user' => function ($query) {
            $query->select('id, first_name, last_name, email,profile_photo');
        }]);

        $query->with(['payment' => function ($query) {
            $query->select('id, payment_success_id, payment_receipt_email,payment_receipt_url, payment_brand,payment_exp_month,payment_exp_year,payment_last4');
        }]);

        //This where filter is for Only Vendor
        if(! (\Yii::$app->user->isGuest) ){
            $user =  \Yii::$app->user->identity;
            if( isset($user->role_id) && ($user->role_id == '2')){
                $query->joinWith(['experience'])->where(['=','experiences.user_id',$user->id]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'experience_id' => $this->experience_id,
            'user_id' => $this->user_id,
            'payment_id' => $this->payment_id,
            'experience_price' => $this->experience_price,
            'experience_adons_price' => $this->experience_adons_price,
            'net_pay' => $this->net_pay,
            'experience_avl_id' => $this->experience_avl_id,
            'experience_start_date' => $this->experience_start_date,
            'experience_end_date' => $this->experience_end_date,
            'schedule_detail' => $this->schedule_detail,
            'total_guest_adults' => $this->total_guest_adults,
            'total_guest_children' => $this->total_guest_children,
            'total_guest_infants' => $this->total_guest_infants,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'experience_id', $this->experience_id])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'payment_id', $this->payment_id])
            ->andFilterWhere(['like', 'experience_price', $this->experience_price])
            ->andFilterWhere(['like', 'net_pay', $this->net_pay])
            ->andFilterWhere(['like', 'experience_adons_price', $this->experience_adons_price])
            ->andFilterWhere(['like', 'experience_start_date', $this->experience_start_date])
            ->andFilterWhere(['like', 'experience_end_date', $this->experience_end_date]);

        return $dataProvider;
    }
}
