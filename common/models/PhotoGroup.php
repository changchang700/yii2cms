<?php
namespace common\models;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%photo_group}}".
 *
 * @property string $id
 * @property string $name
 * @property string $notice
 * @property integer $created_at
 * @property integer $updated_at
 */
class PhotoGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['notice'], 'string', 'max' => 500],
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
            'id' => '主键',
            'name' => '相册名称',
            'notice' => '相册描述',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }
	
	public static function dropDown(){
		$data = self::find()->asArray()->all();
		$data_list = ArrayHelper::map($data, 'id', 'name');
		return $data_list;
	} 
	public static function dropDownHavaAll(){
		$drop_down_list =self::dropDown();
		$drop_down_list[""] = "全部相册";
		ksort($drop_down_list);
		return $drop_down_list;
	}
}
