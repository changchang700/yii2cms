<?php
namespace rbac\models\form;

use Yii;
use rbac\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class Signup extends Model
{
    public $username;
	public $nickname;
	public $head_pic;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
			['nickname', 'string', 'max' => 32],
            ['username', 'unique', 'targetClass' => 'rbac\models\User', 'message' => 'This username has already been taken.'],
            [['username','head_pic'], 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'rbac\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
			$user->nickname = $this->nickname;
			$user->head_pic = $this->head_pic;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
	
    public function attributeLabels()
    {
        return [
			'nickname' => '用户昵称',
            'username' => '用户名',
			'head_pic' => '用户头像',
            'email' => '电子邮箱',
			'password' => '用户密码',
        ];
    }
}
