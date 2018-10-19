<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
	'name' => 'alili后台管理系统',
    'basePath' => dirname(__DIR__),
    'language' => 'zh-CN',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        "rbac" => [        
            'class' => 'rbac\Module',
        ],
        "system" => [        
            'class' => 'system\Module',
        ],
        "backup" => [        
            'class' => 'backup\Module',
        ],
    ],
    "aliases" => [    
        '@rbac' => '@backend/modules/rbac',
		'@system' => '@backend/modules/system',
		'@backup' => '@backend/modules/backup',
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'rbac\models\User',
            'loginUrl' => array('/rbac/user/login'),
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        "authManager" => [        
            "class" => 'yii\rbac\DbManager',   
            "defaultRoles" => ["guest"],    
        ],
        "urlManager" => [       
            "enablePrettyUrl" => true,        
            "enableStrictParsing" => false,     
            "showScriptName" => false,       
            "suffix" => "",    
            "rules" => [        
                "<controller:\w+>/<id:\d+>"=>"<controller>/view",  
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>"    
            ],
        ],
    ],
    'as access' => [
        'class' => 'rbac\components\AccessControl',
        'allowActions' => [
            'rbac/user/request-password-reset',
            'rbac/user/reset-password'
        ]
    ],
    'params' => $params,
];
