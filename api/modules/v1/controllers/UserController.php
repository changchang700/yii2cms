<?php

namespace api\modules\v1\controllers;

use yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;
use api\models\LoginForm;

class UserController extends ActiveController
{	
    public $modelClass = 'common\models\User';

    public function behaviors() {
        return ArrayHelper::merge (parent::behaviors(), [ 
                'authenticator' => [ 
                    'class' => QueryParamAuth::className(),
					'optional' => [
						'login',
					],
                ] 
        ] );
    }
	
	public function actionLogin ()
	{
		$model = new LoginForm;
		$model->setAttributes(Yii::$app->request->post());
        if ($model->login()) {
            return ['access_token' => $model->login()];
        }
        else {
            $model->validate();
            return $model;
        }
	}
}
