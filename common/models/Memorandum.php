<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%memorandum}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content 内容
 * @property int $created_at
 * @property int $updated_at
 */
class Memorandum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%memorandum}}';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => '内容',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
