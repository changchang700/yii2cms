<?php
$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'SHp532xqADsSwgX2TgdLog6Xqg3Mi7QF',
        ],
    ],
	'modules'=>[
		'gii' => [
			'class' => 'yii\gii\Module',
			// 配置访问IP地址
			'allowedIPs' => ['127.0.0.1', '::1'] ,
				'generators' => [ 
			'crud' => [ //生成器名称 
				'class' => 'yii\gii\generators\crud\Generator', 
				'templates' => [ //设置我们自己的模板 
					//模板名 => 模板路径 
					'myCrud' => '@backend/gii/crud', 
				] 
			] 
			], 
		],
		'debug' => [
			'class' => 'yii\debug\Module',
			 // 配置访问IP地址
			'allowedIPs' => ['127.0.0.1', '::1']
		],
	]
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
