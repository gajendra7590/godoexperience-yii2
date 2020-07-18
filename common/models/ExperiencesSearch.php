<?php

namespace common\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Experiences;

/**
 * ExperiencesSearch represents the model behind the search form of `admin\models\Experiences`.
 */
class ExperiencesSearch extends Experiences
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id','featured', 'user_id', 'status'], 'integer'],
            [['title', 'sub_title', 'description', 'experiences_image_url', 'experiences_video_url', 'created_at', 'updated_at'], 'safe'],
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
        $logged_user_role = Yii::$app->user->identity->role_id;
        $logged_user_id = Yii::$app->user->identity->id;


        $query = Experiences::find()->orderBy(['id'=>SORT_DESC]);

        //Call Mapping Data
        $query->with(['category' => function ($query) {
            $query->select('id, name, title');
        }]);

        $query->with(['user' => function ($query) {
            $query->select('id, first_name, last_name');
        }]);

        $query->where('status!=2');

        //This check is for if filter by vendor
        if( (isset($params['vendor'])) && ($params['vendor'] > 0) && ($logged_user_role == '1')){
            $query->andWhere('user_id='.$params['vendor']);
        }

        //This check is for Vendor logged in
        if($logged_user_role == '2'){
            $query->andWhere('user_id='.$logged_user_id);
        }



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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'featured' => $this->featured,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'experiences_image_url', $this->experiences_image_url])
            ->andFilterWhere(['like', 'experiences_video_url', $this->experiences_video_url]);

        

        // echo $query->createCommand()->getRawSql();die;
        return $dataProvider;
    }
}
