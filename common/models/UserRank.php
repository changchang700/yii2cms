<?php
namespace common\models;

use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "user_rank".
 *
 * @property string $id
 * @property string $name
 * @property integer $score
 * @property string $discount
 * @property integer $status
 *
 * @property User[] $users
 */
class UserRank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_rank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'score', 'discount', 'status'], 'required'],
            [['score', 'status'], 'integer'],
            [['discount'], 'number'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '等级名称',
            'score' => '分值',
            'discount' => '折扣',
            'status' => '状态',
        ];
    }
	/**
	 * 获取类别的下拉菜单
	 * @return type
	 */
	public static function dropDown(){
		$data = self::find()->asArray()->all();
		$data_list = ArrayHelper::map($data, 'id', 'name');
		return $data_list;
	} 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['r_id' => 'id']);
    }
}
