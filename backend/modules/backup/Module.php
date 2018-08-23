<?php
/**
 * Created by PhpStorm.
 * User: yidashi
 * Date: 16/3/2
 * Time: 下午4:18
 */

namespace backup;


class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config/main.php'));
    }
}