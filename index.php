<?php

// Activate PHP errors for debugging

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// We have just to edit this file to add a new controller
$routes = require('routes.php');

require 'helpers.php';
require 'model/conn.php';

$all = explode('?', $_SERVER['REQUEST_URI']);
$uri_parts = explode('/', $all[0]);
// exit(var_dump(explode('/', $uri_parts), explode('/', $_SERVER['REQUEST_URI'])));

// $uri_parts = explode('/', $_SERVER['REQUEST_URI']);
$site_name = $uri_parts[1];
$base = $_SERVER['REQUEST_SCHEME'] .'://'.$_SERVER['SERVER_NAME'] . '/' . $site_name . '/';

unset($uri_parts[0]);
unset($uri_parts[1]);
$uri_parts = array_values($uri_parts);

if (sizeof($uri_parts) == 2) {
	$controller = $uri_parts[0];
	$page = $uri_parts[1];
} else {
	$controller = 'home';
	$page = empty($uri_parts[0])? 'home': $uri_parts[0];
}

// if ($controller != 'home' && ! session_exists('role')) {
// 	redirect('');
// 	exit();
// }

if ( ! isset($routes[$controller][$page])) {
	redirect('');
	exit();
}
// var_dump(isset($page, $controller));exit();
require (__DIR__ . '/controller/' . $controller . '.php');

$callable = $page . '_page';
$vars = $callable();

if ($vars) {
	extract($vars);
}

// var_dump(microtime(true));
ob_start();
$view = "views/$controller/$page.php";		
require $view;
$content = ob_get_clean();
// var_dump(microtime(true));

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	echo $content;
}
else{
	$template = isset($template) ? $template: $controller.'/template';
	get_session('datas');
	require  "views/$template.php";
	
}


