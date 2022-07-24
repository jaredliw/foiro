<?php
require_once __DIR__ . "/_utils/security.php";
check_access("admin");

require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/contest.php";

$json = json_read();
$contest_id = compulsory_param(@$json->id);

check_contest_exists($contest_id, true);
delete_contest($contest_id);

json_write(200, "Pertandingan dengan kod '" . $contest_id . "' telah dihapuskan.");
