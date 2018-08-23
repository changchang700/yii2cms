<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'language' => 'zh-CN',
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        "v1" => [        
            'class' => 'api\modules\v1\Module',
        ],
    ],
    'components' => [
        'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'enableSession' => false,
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
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => true,
			'rules' => [
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => ['v1/article'],
					'pluralize'=>false,
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => ['v1/user'],
					'pluralize'=>false,
                    'extraPatterns' => [
                        'POST login' => 'login',
                    ]
				]
			]
		],
    ],
    'params' => $params,
];
