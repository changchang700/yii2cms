<?php
namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Photo;

/**
 * PhotoSearch represents the model behind the search form about `common\models\Photo`.
 */
class PhotoSearch extends Photo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'g_id', 'created_at'], 'integer'],
            [['src', 'notice'], 'safe'],
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
        $query = Photo::find();

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
            'g_id' => $this->g_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'src', $this->src])
            ->andFilterWhere(['like', 'notice', $this->notice]);

        return $dataProvider;
    }
}
