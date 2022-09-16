<?php

header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("X-Permitted-Cross-Domain-Policies: none");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("Referrer-Policy: no-referrer-when-downgrade");
header("Expect-CT: enforce, max-age=31536000, report-uri='https://your.report-uri.com/r/d/ct/enforce'");

$App->router->any('/*:path', function($request) use ($App) {
	$vars = []; 
	
	if (file_exists($App->router->controller($request->route->path))) {
		@include $App->router->controller($request->route->path);
	}

	$vars['config'] = $App->config;

	$vars['SEO'] = new True\SEO;

	# check selected nav item
	$vars['selectedNav'] = (object) [$request->route->path => ' class="sel"'];
	
	$App->view->render($request->route->path.'.phtml', $vars);
});
