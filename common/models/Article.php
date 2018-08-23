<?php
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property string $group_id
 * @property string $music_id
 * @property string $title
 * @property string $content
 * @property string $first_img
 * @property string $is_open
 * @property string $view_password
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $author
 * @property string $visited_number
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
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
            [['group_id', 'music_id', 'title', 'content', 'first_img', 'is_open'], 'required'],
            [['group_id', 'music_id', 'is_open', 'created_at', 'updated_at', 'visited_number'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 200],
            [['first_img'], 'string', 'max' => 300],
            [['view_password'], 'string', 'max' => 50],
            [['author'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'group_id' => '文章所属分类',
            'music_id' => '文章背景音乐',
            'title' => '文章标题',
            'content' => '文章内容',
            'first_img' => '文章首图',
            'is_open' => '是否公开',
            'view_password' => '查看密码',
            'created_at' => '添加日期',
            'updated_at' => '更新时间',
            'author' => '文章作者',
            'visited_number' => '浏览次数',
        ];
    }
	
	public static function getArticleTitle($id){
		return self::findOne($id)->title;
	}
	
	//增加和修改时间
    public function beforeSave($insert) {
        if(parent::beforeSave($insert)){
            //如果是新增的话则添加创建时间
            if($insert){
				$this->author = Yii::$app->user->identity->nickname;
			}
            return true;
        }else{
            return false;
        }
    }
}
