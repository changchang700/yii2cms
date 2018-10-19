<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models\Config;

class ToolsController extends Controller
{
	/**
	 * 富文本编辑器上传文件
	 */
    public function actionUploadEditor()
    {
        $file = $_FILES;
        $file_name = $file['wangEditorH5File']['name'];
        $file_tmp_path =$file['wangEditorH5File']['tmp_name'];
        $dir = "../../uploads/".date("Ymd");
        if (!is_dir($dir)){
            mkdir($dir,0777);
        }
		$type = substr(strrchr($file_name, '.'), 1);
		$mo = Config::findOne(['name'=>'WEB_SITE_ALLOW_UPLOAD_TYPE']);
		$allow_type = explode(',', $mo->value);
		if(!in_array($type, $allow_type)){
			die("文件类型为允许的格式");
		}
        $file_save_name = date("YmdHis",time()) . mt_rand(1000, 9999) . '.' . $type;
        move_uploaded_file($file_tmp_path, $dir.'/'.$file_save_name);
        echo Config::findOne(['name'=>'WEB_SITE_RESOURCES_URL'])->value . date('Ymd').'/'.$file_save_name;
    }
    public function actionUpload()
    {
        $file = $_FILES;
        $file_name = $file['file']['name'];
        $file_tmp_path =$file['file']['tmp_name'];
        $dir = "../../uploads/".date("Ymd");
        if (!is_dir($dir)){
            mkdir($dir,0777);
        }
		$type = substr(strrchr($file_name, '.'), 1);
		$mo = Config::findOne(['name'=>'WEB_SITE_ALLOW_UPLOAD_TYPE']);
		$allow_type = explode(',', $mo->value);
		if(!in_array($type, $allow_type)){
			die("文件类型为允许的格式");
		}
        $file_save_name = date("YmdHis",time()) . mt_rand(1000, 9999) . '.' . $type;
        move_uploaded_file($file_tmp_path, $dir.'/'.$file_save_name);
        echo json_encode(array("code"=>"200","data"=>Config::findOne(['name'=>'WEB_SITE_RESOURCES_URL'])->value . date('Ymd').'/'.$file_save_name));
    }
	public function actionIco(){
		return $this->render('ico');
	}
}
