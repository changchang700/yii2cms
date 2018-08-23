<?php

namespace rbac\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use rbac\models\Log as LogModel;

/**
 * Menu represents the model behind the search form about [[\izyue\admin\models\Menu]].
 * 
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Log extends LogModel
{

    public $admin;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route', 'admin', 'url', 'admin_email', 'ip'], 'safe'],
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
     * Searching menu
     * @param  array $params
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params)
    {
        $query = LogModel::find()->joinWith(['admin' => function ($query) {
            $userModel = new $this->userClassName;
            $query->from($userModel::tableName() . ' admin');
        }])->from(Log::tableName() . ' log');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $sort = $dataProvider->getSort();

        $sort->defaultOrder = ['created_at' => SORT_DESC];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'lower(log.route)', strtolower($this->route)])
            ->andFilterWhere(['like', 'lower(admin.username)', $this->admin])
            ->andFilterWhere(['like', 'lower(log.admin_email)', $this->admin_email])
            ->andFilterWhere(['like', 'lower(log.ip)', $this->ip])
            ->andFilterWhere(['like', 'lower(log.url)', strtolower($this->url)]);

        return $dataProvider;
    }
}
