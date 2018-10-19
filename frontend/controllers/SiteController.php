<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class SiteController extends Controller
{
	public $enableCsrfValidation = false;

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        echo 'hello world!';
    }
}
