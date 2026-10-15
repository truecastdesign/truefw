<?php
/**
 * Copies each app/config/*.dist file to its live name if the live file
 * does not already exist. Runs automatically after `composer create-project`
 * and can be re-run by hand: php bin/setup-config.php
 */
$root = dirname(__DIR__);
foreach (glob($root.'/app/config/*.dist') as $dist) {
	$live = substr($dist, 0, -5);
	if (file_exists($live)) {
		continue;
	}
	copy($dist, $live);
	echo 'Created '.substr($live, strlen($root) + 1).PHP_EOL;
}
