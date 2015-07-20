<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'homeUrl'=>'/basicmnrega/web/index.php',
   'language'=>'hi',
    'components' => [
    'assetManager'=>['linkAssets'=>true],
    'authManager' => [
		  'class' => '\yii\rbac\DbManager',
		 'ruleTable' => '{{%authrule}}', // Optional
		  'itemTable' => '{{%authitem}}',  // Optional
		  'itemChildTable' => '{{%authitemchild}}',  // Optional
		  'assignmentTable' => '{{%authassignment}}',  // Optional
		  ],
	'cache'=>
	    [
	
    'class' => 'yii\caching\FileCache',
	    ],
    'urlManager' => [
			'enablePrettyUrl' => true,
		//	'enableStrictParsing' => true,
    //'showScriptName' => false,
			'rules' => [
				['class' => 'yii\rest\UrlRule', 'controller' => 'api/photo'],
				['class' => 'yii\rest\UrlRule', 'controller' => 'api/work'],
				
				['class' => 'yii\rest\UrlRule', 'controller' => 'api/pp',
				    'extraPatterns' => [
                        'GET remote' => 'remote',
                    ],],
				//'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			],
			],
                    'request' => [
                        'parsers' => [
                                'application/json' => 'yii\web\JsonParser',
                        ],
                        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                        'cookieValidationKey' => 'Mm6heaay14ty6CILacC5z7C5T8CR4NuB',
                ],
                'cache' => [
                        'class' => 'yii\caching\FileCache',
                ],
        'user' => [
            'identityClass' => 'app\modules\users\models\User',
            'enableAutoLogin' => true,
            'loginUrl'=>null,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules'=>[
    'complaint'=>['class'=>'app\modules\complaint\Module'],
    'users'=>['class'=>'app\modules\users\Module'],
    'reply'=>['class'=>'app\modules\reply\Module'],
    'work'=>['class'=>'app\modules\work\Module'],
    'gridview'=>['class'=>'kartik\grid\Module'],
    'api'=>['class'=>'app\modules\api\Module'],
    'gpsphoto'=>['class'=>'app\modules\gpsphoto\Module'],
    'mnrega'=>['class'=>'app\modules\mnrega\Module'],
    'taxonomy'=>['class'=>'app\modules\taxonomy\Module'],
     'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            
        ],
    
    ],
    /*
       'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        
        'allowActions' => [
            'site/*',
            //'admin/*',
            'complaint/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    */
    'params' => $params,
];

if (YII_ENV_DEV) {
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
}

return $config;
