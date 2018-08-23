<?php
/**
 * Created by PhpStorm.
 * User: yidashi
 * Date: 16/3/2
 * Time: 下午8:05
 */

namespace backup\controllers;


use backup\models\Database;
use yii\base\Exception;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\Response;

class ImportController extends Controller
{
    public function actionIndex()
    {
        //列出备份文件列表
        $path = \Yii::$app->controller->module->params['DATA_BACKUP_PATH'];
        if(!is_dir($path)){
            mkdir($path, 0755, true);
        }
        $path = realpath($path);
        $flag = \FilesystemIterator::KEY_AS_FILENAME;
        $glob = new \FilesystemIterator($path,  $flag);

        $list = array();
        foreach ($glob as $name => $file) {
            if(preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)){
                $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');

                $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                $part = $name[6];

                if(isset($list["{$date} {$time}"])){
                    $info = $list["{$date} {$time}"];
                    $info['part'] = max($info['part'], $part);
                    $info['size'] = $info['size'] + $file->getSize();
                } else {
                    $info['part'] = $part;
                    $info['size'] = $file->getSize();
                }
                $extension        = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
                $info['compress'] = ($extension === 'SQL') ? '-' : $extension;
                $info['time']     = strtotime("{$date} {$time}");

                $list["{$date} {$time}"] = $info;
            }
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $list
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * 还原数据库初始化
     * @param int $time
     * @return mixed
     */
    public function actionInit($time = 0)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        //获取备份文件信息
        $name  = date('Ymd-His', $time) . '-*.sql*';
        $path  = realpath(\Yii::$app->controller->module->params['DATA_BACKUP_PATH']) . DIRECTORY_SEPARATOR . $name;
        $files = glob($path);
        $list  = array();
        foreach($files as $name){
            $basename = basename($name);
            $match    = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
            $gz       = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
            $list[$match[6]] = array($match[6], $name, $gz);
        }
        ksort($list);

        //检测文件正确性
        $last = end($list);
        if(count($list) === $last[0]){
            \Yii::$app->session->set('backup_list', $list); //缓存备份列表
            return [
                'status' => 1,
                'part' => 1,
                'start' =>0,
                'info' => '初始化完成！'
            ];
        } else {
            return [
                'status' => 0,
                'info' => '备份文件可能已经损坏，请检查！'
            ];
        }
    }

    public function actionStart()
    {
        $part = \Yii::$app->request->post('part');
        $start = \Yii::$app->request->post('start');
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $list  = \Yii::$app->session->get('backup_list');
        $db = new Database($list[$part], array(
            'path'     => realpath(\Yii::$app->controller->module->params['DATA_BACKUP_PATH']) . DIRECTORY_SEPARATOR,
            'compress' => $list[$part][2]));

        $start = $db->import($start);

        if (false === $start) {
            return ['status' => 0, 'info' => '还原数据出错'];
        } elseif(0 === $start) { //下一卷
            if(isset($list[++$part])){
                return [
                    'status' => 1,
                    'info' => "正在还原...#{$part}",
                    'part' => $part,
                    'start' => 0
                ];
            } else {
                \Yii::$app->session->set('backup_list', null);
                return ['status' => 1, 'info' => '还原完成！'];
            }
        } else {
            if($start[1]){
                $rate = floor(100 * ($start[0] / $start[1]));
                return [
                    'status' => 1,
                    'info' => "正在还原...#{$part} ({$rate}%)",
                    'part' => $part,
                    'start' => $start[0],
                ];
            } else {
                return [
                    'status' => 1,
                    'info' => "正在还原...#{$part}",
                    'part' => $part,
                    'start' => $start[0],
                    'gz' => 1
                ];
            }
        }
    }
    public function actionDel()
    {
        \Yii::$app->response->format = 'json';
        $time = \Yii::$app->request->get('time');
        if($time){
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = realpath(\Yii::$app->controller->module->params['DATA_BACKUP_PATH']) . DIRECTORY_SEPARATOR . $name;
            array_map("unlink", glob($path));
            if(count(glob($path))){
				return ['code'=>400,"msg"=>"备份文件删除失败，请检查权限!"];
            } else {
				return ['code'=>200,"msg"=>"备份文件删除成功"];
            }
        } else {
			return ['code'=>400,"msg"=>"参数错误"];
        }
    }
}