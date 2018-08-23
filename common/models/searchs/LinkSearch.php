<?php
namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Link;

/**
 * LinkSearch represents the model behind the search form about `common\models\Link`.
 */
class LinkSearch extends Link
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'created_at'], 'integer'],
            [['site_url', 'site_name', 'site_content', 'site_img', 'site_motto'], 'safe'],
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
        $query = Link::find();

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
            'sort' => $this->sort,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'site_url', $this->site_url])
            ->andFilterWhere(['like', 'site_name', $this->site_name])
            ->andFilterWhere(['like', 'site_content', $this->site_content])
            ->andFilterWhere(['like', 'site_img', $this->site_img])
            ->andFilterWhere(['like', 'site_motto', $this->site_motto]);

        return $dataProvider;
    }
}
