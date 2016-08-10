<?php
spl_autoload_register(function ($class){
	// project-specific namespace prefix
	$prefix = 'FingerPush\\';
	
	// base directory for the namespace prefix
	$baseDir = __DIR__ . '/src/';
	
	// does the class use the namespace prefix?
	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		// no, move to the next registered autoloader
		return;
	}
	
	// get the relative class name
	$relativeClass = substr($class, $len);
	
	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
	
	// if the file exists, require it
	if (file_exists($file)) {
		require $file;
	}
});

/********************************************************************************
 * 
 * PHP 5.3.0 이하 버전 autoload 문제로 안될경우 include 또는 require 객체 사용
 * 
 ********************************************************************************/
 
// require_once ('src/FingerPush.php');
// require_once ('src/FingerPushApp.php');
// require_once ('src/FingerPushClient.php');
// require_once ('src/FingerPushRequest.php');
