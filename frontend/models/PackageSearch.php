<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Package;

/**
 * PackageSearch represents the model behind the search form of `common\models\Package`.
 */
class PackageSearch extends Package
{
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'price', 'status', 'user_create'], 'integer'],
      [['name', 'details', 'date_moment', 'place', 'key_images', 'date_create'], 'safe'],
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
    $query = Package::find();

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
      'price' => $this->price,
      'status' => $this->status,
      'user_create' => $this->user_create,
    ]);

    $query->andFilterWhere(['like', 'name', $this->name])
      ->andFilterWhere(['like', 'name', $params['name']])
      ->andFilterWhere(['like', 'details', $this->details])
      ->andFilterWhere(['like', 'date_moment', $this->date_moment])
      ->andFilterWhere(['like', 'place', $this->place])
      ->andFilterWhere(['like', 'key_images', $this->key_images])
      ->andFilterWhere(['like', 'date_create', $this->date_create]);

    return $dataProvider;
  }
}
