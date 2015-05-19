<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');
require_once __DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'vendor', 'autoload.php']);
require_once __DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'vendor', 'yiisoft', 'yii2', 'Yii.php']);

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config= [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
         'users'=>['class'=>'app\modules\users\Module'],
    'reply'=>['class'=>'app\modules\reply\Module'],
    'work'=>['class'=>'app\modules\work\Module'],
    
    ],
    'components' => [
    'authManager' => [
		  'class' => '\yii\rbac\DbManager',
		  'ruleTable' => 'authrule', // Optional
		  'itemTable' => 'authitem',  // Optional
		  'itemChildTable' => 'authitemchild',  // Optional
		  'assignmentTable' => 'authassignment',  // Optional
		  ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    
    'params' => $params,
];

    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    $config['modules']['gii'] = ['class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
            'generators' => [ //here
                'crud' => [ // generator name
                    'class' => 'yii\gii\generators\crud\Generator', // generator class
                    'templates' => [ //setting for out templates
                        'myCrud' => '@app/giitemplatesNew/crud/default', // template name => path to template
                    ]
                ],
                'model' => [ // generator name
                    'class' => '\app\giiTemplatesNew\model\Generator', // generator class
                    'templates' => [ //setting for out templates
                        'myModel' => '@app/giitemplatesNew/model/default', // template name => path to template
                    ]
                ],
                
            ],
            ];


return $config;