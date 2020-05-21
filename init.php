<?php
session_start();

require_once 'vendor/autoload.php';

define('BP', __DIR__);

$App = new \True\App;

$App->load(BP.'/app/config/site.ini');

if ($App->config->site->debug) {
	$GLOBALS['debug'] = true;
	error_reporting(E_ALL & ~E_NOTICE);
} else {
	$GLOBALS['debug'] = false;
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
}

$App->view = new \True\PhpView;

# global css and js files
$App->view->css = '/vendor/truecastdesign/true/assets/default.css, /assets/css/site.css'; # global css files
#$App->view->js = '/assets/js/file1.js, /assets/js/file2.js'; # global js files

# check routes
require 'app/routes.php';