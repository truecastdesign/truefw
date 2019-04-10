<?php
session_start();

ini_set('display_errors', 'On');
error_reporting(E_ALL & ~E_NOTICE);

require 'vendor/autoload.php';

define('BP', __DIR__);

$App = new \True\App;

$App->load('../app/config/site.ini');

$App->view = new \True\PhpView;

# global css and js files
$App->view->css = '/assets/css/site.css'; # global css files
#$App->view->js = '/assets/js/file1.js, /assets/js/file2.js'; # global js files

# check routes
require 'app/routes.php';