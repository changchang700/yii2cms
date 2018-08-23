<?php

namespace system\controllers;

use Yii;
use common\models\User;
use common\models\searchs\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {        
        $model = new User();
		$post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $model->generateAuthKey();
            $model->password_hash=Yii::$app->security->generatePasswordHash($post_data['User']['password_hash']);
			$model->created_ip = Yii::$app->ipaddress->getIp();
			$model->created_address = Yii::$app->ipaddress->getIpAddress($model->created_ip);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
			if($post_data['User']['password_hash']){
				$model->password_hash=Yii::$app->security->generatePasswordHash($post_data['User']['password_hash']);
			}
            $model->password_reset_token = null;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionActive($id)
    {
		$model = $this->findModel($id);
		if($model->status== User::STATUS_ACTIVE){
			return json_encode(['code'=>400,"msg"=>"该用户是已经是启用状态"]);
		}
		
		$model->status = User::STATUS_ACTIVE;
		
		if($model->save()){
			return json_encode(['code'=>200,"msg"=>"启用成功"]);
		}else{
			$errors = $model->firstErrors;
			return json_encode(['code'=>400,"msg"=>reset($errors)]);
		}
    }
	
    public function actionInactive($id)
    {	
		$model = $this->findModel($id);
		if($model->status== User::STATUS_DELETED){
			return json_encode(['code'=>400,"msg"=>"该用户是已经是禁用状态"]);
		}
		
		$model->status = User::STATUS_DELETED;
		
		if($model->save()){
			return json_encode(['code'=>200,"msg"=>"禁用成功"]);
		}else{
			$errors = $model->firstErrors;
			return json_encode(['code'=>400,"msg"=>reset($errors)]);
		}
    }
	
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$model = $this->findModel($id);
		if($model->delete()){
			return json_encode(['code'=>200,"msg"=>"删除成功"]);
		}else{
			$errors = $model->firstErrors;
			return json_encode(['code'=>400,"msg"=>reset($errors)]);
		}
    }

    public function actionDeleteAll(){
        $data = Yii::$app->request->post();
        if($data){
            $model = new User;
            $count = $model->deleteAll(["in","id",$data['keys']]);
            if($count>0){
                return json_encode(['code'=>200,"msg"=>"删除成功"]);
            }else{
				$errors = $model->firstErrors;
                return json_encode(['code'=>400,"msg"=>reset($errors)]);
            }
        }else{
            return json_encode(['code'=>400,"msg"=>"请选择数据"]);
        }
    }
	
	public function actionOnlineUsers(){
		return $this->render('online-users');
	}
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
