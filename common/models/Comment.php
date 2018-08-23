<?php
namespace common\models;

use common\models\User;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property integer $u_id
 * @property integer $article_id
 * @property integer $parent_id
 * @property string $comment_content
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'article_id', 'comment_content'], 'required'],
            [['u_id', 'article_id', 'parent_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['comment_content'], 'string'],
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
            'u_id' => '评论人ID',
            'article_id' => '文章标题',
            'parent_id' => '上级评论内容',
            'comment_content' => '评论内容',
            'created_at' => '评论时间',
            'updated_at' => '修改时间',
            'status' => '状态',
        ];
    }
	//增加和修改时间
    public function beforeSave($insert) {
        if(parent::beforeSave($insert)){
            //如果是新增的话则添加创建时间
            if($insert && (6==User::findOne(['id'=> $this->u_id])->r_id)){
				$this->status = 2;
            }
            return true;
        }else{
            return false;
        }
    }
}
