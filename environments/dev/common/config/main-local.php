<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
			'tablePrefix' => 't_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.126.com',
                'username' => 'email@126.com',
                'password' => 'password',
                'port' => '465',
                'encryption' => 'ssl',
			],
			'messageConfig'=>[
				'charset'=>'UTF-8',
				'from'=>['email@126.com'=>'admin']
			],
		],
    ],
];
