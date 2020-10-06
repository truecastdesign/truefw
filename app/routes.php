<?php

$App->router->any('/*:path', function($request) use ($App) {
	$vars = []; 
	@include $App->router->controller($request->route->path);

	$vars['config'] = $App->config;

	# check selected nav item
	$vars['selectedNav'] = (object) [$request->route->path => ' class="sel"'];
	
	$App->view->render($request->route->path.'.phtml', $vars);
});
