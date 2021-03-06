<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
  'layout'=>'main-2columns',
 // 'layout'=>'cmsadminpanel',
    'homeUrl'=>['site'],
   'language'=>'en',

    'components' => [
     'sms'=>
     [
     'class'=>'\app\components\SendSMSComponent',
     ],
     'response'=>[
                'formatters' => [
                    ]
                ],
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
	    /*
	    'cache' => [
        'class' => 'yii\caching\MemCache',
        'servers' => [
            [
                'host' => '127.0.0.1',
                'port' => 20058,
                'weight' => 100,
            ],

        ],
    ],
	    
	    */
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
            'on '.\yii\web\User::EVENT_AFTER_LOGIN => ['app\modules\users\models\User', 'loginHistory'],
               'on '.\yii\web\User::EVENT_BEFORE_LOGOUT => ['app\modules\users\models\User', 'logoutHistory'],

        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'=>require(__DIR__ . '/mailer.php'),
        /*
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        */
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
        'i18n'=>[
            'translations' => [
                'app'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@app/messages",
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app'=>'app.php',
                       
                    ]
                ],
                'hints'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@app/messages",
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'hints'=>'hints.php',
                    ]
                ]
            ]
        ],
    ],
    'modules'=>[
    'backup' => [
            'class' => 'spanjeta\modules\backup\Module',
        ],
    'docs'=>[
    	'class' => '\app\modules\documents\Module',
	
    ],
    'formats'=>[
        'class' => '\app\modules\formats\Module',
    
    ],
    'corr'=>[
        'class' => '\app\modules\correspondence\Module',
    
    ],
    	'articles' => [
		'class' => '\app\modules\articles\Articles',
		
		// Select Languages allowed
		'languages' => [ 
			"it-IT" => "it-IT", 
			"en-GB" => "en-GB" 
		],			
		// Select Editor: no-editor, ckeditor, imperavi, tinymce, markdown
		'editor' => 'ckeditor',
		// Select Path To Upload Category Image
		'categoryImagePath' => 'img/articles/categories/',
		// Select Path To Upload Category Thumb
		'categoryThumbPath' => 'img/articles/categories/thumb/',
		// Select Path To Upload Item Image
		'itemImagePath' => 'img/articles/items/',
		// Select Path To Upload Item Thumb
		'itemThumbPath' => 'img/articles/items/thumb/',
		// Select Image Name: categoryname, original, casual
		'imageNameType' => 'categoryname',
		// Select Image Types allowed
		'imageType'     => 'jpg,jpeg,gif,png',
		// Thumbnails Options
		'thumbOptions'  => [ 
			'small'  => ['quality' => 100, 'width' => 150, 'height' => 100],
			'medium' => ['quality' => 100, 'width' => 200, 'height' => 150],
			'large'  => ['quality' => 100, 'width' => 300, 'height' => 250],
			'extra'  => ['quality' => 100, 'width' => 400, 'height' => 350],
		],
	],	
	// Module Kartik-v Grid
	'gridview' =>  [
		'class' => '\kartik\grid\Module',
	],	
	// Module Kartik-v Markdown Editor
	'markdown' => [
		'class' => 'kartik\markdown\Module',
	],
     'vote' => [
        'class' => 'chiliec\vote\Module',
        'allow_guests' => false, // if true will check IP, otherwise - UserID
        'allow_change_vote' => true, // if true vote can be changed
        'matchingModels' => [ // matching model names with whatever unique integer ID
            'pond' => 0, // may be just integer value
            //'audio' => ['id'=>1], // or array with 'id' key
           // 'video' => ['id'=>2, 'allow_guests'=>false], // own value 'allow_guests'
           // 'photo' => ['id'=>3, 'allow_guests'=>false, 'allow_change_vote'=>false],
        ],      
    ],
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
            'as access' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['Administrator'],
                ]
            ]
        ],
            
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

    $config['modules']['debug'] = 
                                 ['class'=>'yii\debug\Module', 'allowedIPs' => ['122.163.195.132', '127.0.0.1', '::1']];


    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] =['class'=> 'yii\gii\Module', 'allowedIPs' => ['']];
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
