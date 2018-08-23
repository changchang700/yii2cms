<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;

class ArticleController extends ActiveController
{	
    public $modelClass = 'common\models\Article';
	
    public function behaviors() {
        return ArrayHelper::merge (parent::behaviors(), [ 
                'authenticator' => [ 
                    'class' => QueryParamAuth::className(),
					'tokenParam' => 'access_token',
                ] 
        ] );
    }
}
