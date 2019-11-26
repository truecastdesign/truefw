<?php
$GLOBALS['debug'] = true;
$GLOBALS['dev'] = true;

session_start();

if ($GLOBALS['debug']) {
	error_reporting(E_ALL);
} else {
	error_reporting(E_ALL & E_WARNING & ~E_NOTICE);
}

define('BP', __DIR__);

require 'vendor/autoload.php';

$App = new \True\App;

$App->load('../app/config/site.ini');

$App->view = new \True\PhpView;

# global css and js files
$App->view->css = '/vendor/truecastdesign/true/assets/default.css, /assets/css/site.css'; # global css files
#$App->view->js = '/assets/js/file1.js, /assets/js/file2.js'; # global js files

# check routes
require 'app/routes.php';