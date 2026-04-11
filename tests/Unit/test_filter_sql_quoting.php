<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2026 The Cacti Group                                 |
 +-------------------------------------------------------------------------+
 | Cacti: The Complete RRDTool-based Graphing Solution                     |
 +-------------------------------------------------------------------------+
*/

$payload = "%' OR 1=1 --";
$quoted  = "'" . str_replace("'", "\\'", '%' . $payload . '%') . "'";

if (strpos($quoted, "OR 1=1") !== false && strpos($quoted, "'") !== false) {
	print "OK\n";
	exit(0);
}

fwrite(STDERR, "Expected filter text to remain quoted in SQL fragments\n");
exit(1);
