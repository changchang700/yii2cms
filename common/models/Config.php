<?php
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "config".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $value
 * @property string $remark
 * @property string $created_at
 * @property string $updated_at
 * @property integer $sort
 * @property integer $status
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['created_at', 'updated_at', 'sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 100],
            [['name'], 'unique'],
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
            'id' => 'ID',
            'name' => '配置键名',
            'title' => '名称',
            'value' => '配置键值',
            'remark' => '备注',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'sort' => '排序值',
            'status' => '状态',
        ];
    }
	
	public function beforeSave($insert) {
		if(parent::beforeSave($insert)){
			Yii::$app->memcache->delete($this->name);
			return true;
		}
	}
	
	public static function getHtmlStatus($id){
		if(isset(self::findOne($id)->status) && self::findOne($id)->status==0){
			return true;
		}else{
			return false;
		}
	}
	
	public static function getConfig($name){
		$config = Yii::$app->memcache->get($name);
		if(!$config){
			$config = self::findOne(['name'=>$name])->value;
			Yii::$app->memcache->set($name,$config);
		}
		return $config;
	}
}
