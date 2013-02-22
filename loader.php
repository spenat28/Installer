<?php

/*
 * Install script for standard Nette Project
 */

namespace Installer;

// Version
define('INSTALLER_VERSION', '0.1');

// Definition of dispatching URI
define('ROOT_DIR', __DIR__);
define('ROOT_PATH', substr(ROOT_DIR, strlen($_SERVER['DOCUMENT_ROOT'])));
define('DISPATCH_URI', substr($_SERVER['REQUEST_URI'], strlen(ROOT_PATH)));

// Vendor DIR
define('VENDOR_DIR', ROOT_DIR . '/vendor');
// Composer autoloader
require_once VENDOR_DIR . '/autoload.php';

// Templates dir
define('TEMPLATES_DIR', ROOT_DIR . '/template');

// controllers dir
define('CONTROLERS_DIR', ROOT_DIR . '/controller');

// libs dir
define('LIBS_DIR', __DIR__ . '/lib');

// load classes
require_once LIBS_DIR . '/includes.php';
require_once LIBS_DIR . '/misc.php';
require_once LIBS_DIR . '/functions.php';


respond(function ($request, $response) {
    $response->layout(TEMPLATES_DIR . '/layout.phtml');
});

respond('/[:controller]/[:action]?/[i:id]?', function ($request, $response, $app) {
    extract($request->params('controller','action', 'id'));
	if(!$action)
		$action = 'default';
	$actionName = $action;
	$controllerName = $controller;
	$controller = '\\Installer\\'.ucfirst($controllerName) . 'Controller';
	if(class_exists($controller))
		$controller = new $controller($request, $response, $app);
	else {
		$response->render(TEMPLATES_DIR . '/404.phtml');
		return;
	}
    $action = 'action' . ucfirst($action);
	if(!method_exists($controller, $action)){
		$view = TEMPLATES_DIR . '/'. $controllerName .'/'. $actionName .'.phtml';
		if(!file_exists($view))
			$response->render(TEMPLATES_DIR . '/404.phtml');
		else
			$response->render($view);
	} else {
		$controller->$action($id);
	}
});

respond('/', function ($request, $response) {
    $response->render(TEMPLATES_DIR . '/homepage.phtml');
});

respond('404', function ($request, $response) {
    $response->render(TEMPLATES_DIR . '/404.phtml');
});

dispatch(DISPATCH_URI);

/*

$installed = FALSE;

//check if project was already installed
if(file_exists(__DIR__ . '/AlreadyInstalled'))
	$installed = TRUE;


// include template
require_once __DIR__ . '/template.html';
 */