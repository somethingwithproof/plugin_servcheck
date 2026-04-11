<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2026 The Cacti Group                                 |
 +-------------------------------------------------------------------------+
 | Cacti: The Complete RRDTool-based Graphing Solution                     |
 +-------------------------------------------------------------------------+
*/

$checks = array(
	__DIR__ . '/../../servcheck_proxies.php' => array(
		"(name LIKE ' . db_qstr('%' . get_request_var('filter') . '%') . ' OR hostname LIKE ' . db_qstr('%' . get_request_var('filter') . '%') . ')'",
	),
	__DIR__ . '/../../servcheck_ca.php' => array(
		"'name LIKE ' . db_qstr('%' . get_request_var('filter') . '%')",
	),
);

foreach ($checks as $path => $patterns) {
	$contents = file_get_contents($path);

	if ($contents === false) {
		fwrite(STDERR, "Unable to read {$path}\n");
		exit(1);
	}

	foreach ($patterns as $pattern) {
		if (strpos($contents, $pattern) === false) {
			fwrite(STDERR, "Missing expected SQL hardening: {$pattern}\n");
			exit(1);
		}
	}
}

print "OK\n";
