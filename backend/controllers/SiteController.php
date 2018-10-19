<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$sql1='SELECT
					ip,
					FROM_UNIXTIME(created_at, "%Y-%m-%d"),
					COUNT(*) as num
				FROM
					t_admin_log
				WHERE
					FROM_UNIXTIME(created_at, "%Y-%m-%d") = date_format(NOW(), "%Y-%m-%d")
				GROUP BY
					ip';
		$rows1=Yii::$app->db->createCommand($sql1)->query();
		$x1 = [];
		$y1 = [];
		foreach($rows1 as $value){
			$x1[]=$value['ip'];
			$y1[]=$value['num'];
		}
		
		$sql = 'SELECT
					FROM_UNIXTIME(created_at, "%Y-%m-%d") as date,
					COUNT(*) as num
				FROM
					t_admin_log
				GROUP BY
					FROM_UNIXTIME(created_at, "%Y-%m-%d")';
		$rows=Yii::$app->db->createCommand($sql)->query();
		$x = [];
		$y = [];
		foreach($rows as $value){
			$x[]=$value['date'];
			$y[]=$value['num'];
		}
        return $this->render('index',["data"=>['x'=>$x,'y'=>$y,'x1'=>$x1,'y1'=>$y1]]);
    }
}
