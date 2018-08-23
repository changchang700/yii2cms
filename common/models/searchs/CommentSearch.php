<?php
namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comment;
use common\models\User;

/**
 * CommentSearch represents the model behind the search form about `common\models\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['comment_content','u_id'], 'safe'],
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
        $query = Comment::find();

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
		if($this->u_id){
			$u_id = @User::findOne(['username'=>$this->u_id])->id;
			$query->andWhere(['u_id' => $u_id]);
		}
		
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'comment_content', $this->comment_content]);
		
        return $dataProvider;
    }
}
