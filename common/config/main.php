<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'memcache' => [  
			'class' => 'yii\caching\MemCache',  
			'useMemcached' =>0, //这里简单说明一下 0是memcache, 1是memcached 两个是php里不同的扩展
			'servers' => [  
				[  
					'host' => '127.0.0.1',  
					'port' => 11211,  
					'weight' => 100,  
				]
			],  
		],
    ],
];
