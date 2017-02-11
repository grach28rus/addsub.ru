<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AddSub;

/**
 * AddSubSearch represents the model behind the search form of `common\models\AddSub`.
 */
class AddSubSearch extends AddSub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count'], 'integer'],
            [['user_code', 'category', 'create_at', 'status', 'uodate_at'], 'safe'],
            [['add', 'sub'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = AddSub::find();

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
            'add' => $this->add,
            'sub' => $this->sub,
            'count' => $this->count,
            'create_at' => $this->create_at,
            'uodate_at' => $this->uodate_at,
        ]);

        $query->andFilterWhere(['ilike', 'user_code', $this->user_code])
            ->andFilterWhere(['ilike', 'category', $this->category])
            ->andFilterWhere(['ilike', 'status', $this->status]);

        return $dataProvider;
    }
}
