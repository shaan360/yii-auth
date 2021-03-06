<?php

Yii::setPathOfAlias('bootstrap',realpath(dirname(__FILE__).'/../extensions/bootstrap'));
Yii::setPathOfAlias('auth',realpath(dirname(__FILE__).'/../../..'));

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).'/..',
	'name'=>'Yii-Auth Demo',
	'theme'=>'bootstrap',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'auth'=>array(
			'class'=>'auth.AuthModule',
			'users'=>array('Guest'),
			'forceCopyAssets'=>true,
		),
	),

	// application components
	'components'=>array(
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'behaviors'=>array(
				'auth'=>array(
					'class'=>'auth.components.AuthBehavior',
					'cachingDuration'=>300,
				),
			),
		),
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap',
		),
		'cache'=>array(
			'class'=>'CFileCache',
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=yii_auth',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'debug, info, error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);