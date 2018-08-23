<?php

namespace rbac\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use rbac\models\BizRule as MBizRule;
use rbac\components\RouteRule;
use rbac\components\Configs;

/**
 * Description of BizRule
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class BizRule extends Model
{
    /**
     * @var string name of the rule
     */
    public $name;

    public function rules()
    {
        return [
            [['name'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('rbac-admin', 'Name'),
        ];
    }

    /**
     * Search BizRule
     * @param array $params
     * @return \yii\data\ActiveDataProvider|\yii\data\ArrayDataProvider
     */
    public function search($params)
    {
        /* @var \yii\rbac\Manager $authManager */
        $authManager = Configs::authManager();
        $models = [];
        $included = !($this->load($params) && $this->validate() && trim($this->name) !== '');
        foreach ($authManager->getRules() as $name => $item) {
            if ($name != RouteRule::RULE_NAME && ($included || stripos($item->name, $this->name) !== false)) {
                $models[$name] = new MBizRule($item);
            }
        }

        return new ArrayDataProvider([
            'allModels' => $models,
        ]);
    }
}
