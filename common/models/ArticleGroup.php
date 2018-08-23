<?php
namespace common\models;

use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%group}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $notice
 * @property integer $created_at
 * @property integer $updated_at
 */
class ArticleGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_group}}';
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['notice'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

	/**
	 * 设置自动更新时间戳
	 * @return type
	 */
	public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '文章分类ID',
            'name' => '分类名称',
            'notice' => '备注',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
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
	 * 获取类别的下拉菜单 包括全部选项 用于搜索头部
	 * @return type
	 */
	public static function dropDownHavaAll(){
		$drop_down_list =self::dropDown();
		$drop_down_list[""] = "全部文章";
		ksort($drop_down_list);
		return $drop_down_list;
	}
}
