<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Place;

/**
 * PlaceSearch represents the model behind the search form of `common\models\Place`.
 */
class PlaceSearch extends Place
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'price', 'amphure', 'district', 'province', 'status', 'user_create'], 'integer'],
            [['name', 'details', 'activity', 'contact', 'business_day', 'business_hours', 'key_images', 'latitude', 'longitude', 'date_create'], 'safe'],
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
        $query = Place::find();

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
            'type' => $this->type,
            'price' => $this->price,
            'amphure' => $this->amphure,
            'district' => $this->district,
            'province' => $this->province,
            'status' => $this->status,
            'user_create' => $this->user_create,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'activity', $this->activity])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'business_day', $this->business_day])
            ->andFilterWhere(['like', 'business_hours', $this->business_hours])
            ->andFilterWhere(['like', 'key_images', $this->key_images])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'date_create', $this->date_create]);

        return $dataProvider;
    }
}
