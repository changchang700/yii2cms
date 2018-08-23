<?php
namespace common\models;

use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%link}}".
 *
 * @property string $id
 * @property string $site_url
 * @property string $site_name
 * @property string $site_content
 * @property string $site_img
 * @property string $site_motto
 * @property integer $sort
 * @property integer $created_at
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_url', 'site_name', 'site_content', 'site_img', 'site_motto'], 'required'],
            [['sort', 'created_at','updated_at'], 'integer'],
            [['site_url', 'site_img'], 'string', 'max' => 200],
            [['site_name'], 'string', 'max' => 50],
            [['site_content'], 'string', 'max' => 500],
            [['site_motto'], 'string', 'max' => 300],
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
            'site_url' => '站点URL',
            'site_name' => '站点名称',
            'site_content' => '站点简介',
            'site_img' => '站点图片',
            'site_motto' => '站长座右铭',
            'sort' => '排序',
            'created_at' => '创建时间',
        ];
    }
}
