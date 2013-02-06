<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'linuxred',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
		    'ipFilters'=>false
		),
	    'dev'=>array(
	         'class'=>'application.modules.dev.DevModule'
	        ),
	    'admin'=>array(
	         'class'=>'application.modules.admin.AdminModule'
	            ),
	    'settings'=>array(
	         'class'=>'application.modules.settings.SettingsModule'
	            ),
	    'client'=>array(
	         'class'=>'application.modules.client.ClientModule'    
	            ),
	   'ux'=>array(
	                    'class'=>'application.modules.ux.UxModule'
	            )
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=server',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'linuxred',
			'charset' => 'utf8',
			//'enableProfiling' => YII_DEBUG,
			//'enableParamLogging' => YII_DEBUG
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info, trace, debug',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CFileLogRoute',
					'levels' => 'trace',
					'categories' => 'application.*, system.db.*'
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);