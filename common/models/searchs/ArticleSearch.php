<?php
namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'music_id', 'is_open', 'created_at', 'updated_at', 'visited_number'], 'integer'],
            [['title', 'content', 'first_img', 'view_password', 'author'], 'safe'],
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
        $query = Article::find();

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
		$query->orderBy(['id'=>SORT_DESC]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'group_id' => $this->group_id,
            'music_id' => $this->music_id,
            'is_open' => $this->is_open,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'visited_number' => $this->visited_number,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'first_img', $this->first_img])
            ->andFilterWhere(['like', 'view_password', $this->view_password])
            ->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }
}
