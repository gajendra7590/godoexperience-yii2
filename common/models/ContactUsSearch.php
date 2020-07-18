<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ContactUs;

/**
 * ContactUsSearch represents the model behind the search form of `common\models\ContactUs`.
 */
class ContactUsSearch extends ContactUs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','is_reply','reply_user'], 'integer'],
            [['contact_name', 'contact_email', 'contact_phone', 'contact_message','contact_time','reply_time'], 'safe'],
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
        $query = ContactUs::find();

        $query->orderBy(['id'=>SORT_DESC]);

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
            'is_reply' => $this->is_reply,
            'contact_time' => $this->contact_time,
        ]);

        $query->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'contact_phone', $this->contact_phone])
            ->andFilterWhere(['like', 'is_reply', $this->is_reply])
            ->andFilterWhere(['like', 'contact_message', $this->contact_message]);

        return $dataProvider;
    }
}
