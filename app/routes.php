<?php

$App->any('/:path', function($request) use ($App) {
	$vars = []; 
	@include $App->controller($request->route->path);

	$vars['config'] = $App->config;
	print_r($request);
	# check selected nav item
	$vars['selectedNav'] = (object) [$request->route->path => ' class="sel"'];
	
	$App->view->render($request->route->path.'.phtml', $vars);
});
