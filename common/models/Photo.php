<?php
namespace common\models;

use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%photo}}".
 *
 * @property string $id
 * @property string $src
 * @property integer $g_id
 * @property string $notice
 * @property integer $created_at
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['src', 'g_id'], 'required'],
            [['g_id', 'created_at'], 'integer'],
            [['src'], 'string', 'max' => 255],
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
            'id' => 'ID',
            'src' => '相片地址',
            'g_id' => '所属相册',
            'notice' => '相片描述',
            'created_at' => '添加时间',
        ];
    }
}
