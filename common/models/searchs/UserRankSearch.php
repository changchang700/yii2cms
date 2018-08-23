<?php
namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserRank;

/**
 * UserRankSearch represents the model behind the search form about `common\models\UserRank`.
 */
class UserRankSearch extends UserRank
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'score', 'status'], 'integer'],
            [['name'], 'safe'],
            [['discount'], 'number'],
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
        $query = UserRank::find();

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
            'score' => $this->score,
            'discount' => $this->discount,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
