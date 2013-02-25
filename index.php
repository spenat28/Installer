<?php

/*
 * Install script for standard Nette Project
 */

// EDIT here path to Your project, which You want use installer for
define('APP_DIR', __DIR__ . '/../mShop/app');

//REMOVE temporary after testing
//define('APP_DIR', __DIR__);

define('REQUIREMENTS_DIR', __DIR__ . '/requirements');

$requirements = array(
	'writeableDirectories' => array(
		'../temp',
		'../log',
		'../temp/cache'
	),
	'existingFiles' => array(
		'config/local.neon'
	)
);

// require
require_once __DIR__ . '/loader.php';