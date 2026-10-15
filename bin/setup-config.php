<?php
/**
 * Turns each app/config/*.dist template into its live config file.
 * If the live file is missing, the template is renamed to it.
 * If the live file already exists, the template is simply removed.
 * Runs automatically after `composer create-project`
 * and can be re-run by hand: php bin/setup-config.php
 */
$root = dirname(__DIR__);
foreach (glob($root.'/app/config/*.dist') as $dist) {
	$live = substr($dist, 0, -5);
	$name = substr($live, strlen($root) + 1);
	if (file_exists($live)) {
		unlink($dist);
		echo 'Kept existing '.$name.', removed template'.PHP_EOL;
	} else {
		rename($dist, $live);
		echo 'Created '.$name.PHP_EOL;
	}
}
