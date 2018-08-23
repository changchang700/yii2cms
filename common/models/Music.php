<?php
namespace common\models;

use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%music}}".
 *
 * @property string $id
 * @property string $music_name
 * @property string $music_author
 * @property string $music_url
 * @property string $music_author_img
 * @property integer $created_at
 * @property integer $updated_at
 */
class Music extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%music}}';
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
    public function rules()
    {
        return [
            [['music_name', 'music_author', 'music_url'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['music_name'], 'string', 'max' => 100],
            [['music_author'], 'string', 'max' => 50],
            [['music_url', 'music_author_img'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'music_name' => '音乐名字',
            'music_author' => '音乐作者',
            'music_url' => '音乐url',
            'music_author_img' => '音乐头像',
            'created_at' => '添加时间',
            'updated_at' => '修改时间',
        ];
    }
	/**
	 * 获取类别的下拉菜单
	 * @return type
	 */
	public static function dropDown(){
		$data = self::find()->asArray()->all();
		$data_list = ArrayHelper::map($data, 'id', 'music_name');
		return $data_list;
	} 
}
