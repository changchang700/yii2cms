<?php
/**
 * Created by PhpStorm.
 * User: yidashi
 * Date: 16/3/2
 * Time: 下午4:20
 */
return [
    'params' => [
        'DATA_BACKUP_PATH' => Yii::getAlias('@backup') . '/data/',
        'DATA_BACKUP_PART_SIZE' => 20971520,
        'DATA_BACKUP_COMPRESS' => 1,
        'DATA_BACKUP_COMPRESS_LEVEL' => 9,
    ]
];