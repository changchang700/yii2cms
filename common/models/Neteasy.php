<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%neteasy}}".
 *
 * @property int $id
 * @property string $username 网易账号
 * @property string $password 网易密码
 * @property string $notice_1
 * @property string $notice_2
 * @property int $created_at
 * @property int $updated_at
 */
class Neteasy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%neteasy}}';
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
            [['username'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 128],
            [['password', 'notice_1', 'notice_2'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '网易账号',
            'password' => '网易密码',
            'notice_1' => 'Notice 1',
            'notice_2' => 'Notice 2',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
