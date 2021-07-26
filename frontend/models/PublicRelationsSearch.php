<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PublicRelations;

/**
 * PublicRelationsSearch represents the model behind the search form of `common\models\PublicRelations`.
 */
class PublicRelationsSearch extends PublicRelations
{
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'status', 'user_create'], 'integer'],
      [['type', 'topic', 'details', 'date_imparting', 'key_images', 'date_create'], 'safe'],
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
    $query = PublicRelations::find();

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
      'status' => $this->status,
      'user_create' => $this->user_create,
    ]);

    $query->andFilterWhere(['like', 'type', $this->type])
      ->andFilterWhere(['like', 'topic', $this->topic])
      ->andFilterWhere(['like', 'details', $this->details])
      ->andFilterWhere(['like', 'date_imparting', $this->date_imparting])
      ->andFilterWhere(['like', 'key_images', $this->key_images])
      ->andFilterWhere(['like', 'date_create', $this->date_create]);

    return $dataProvider;
  }
}
