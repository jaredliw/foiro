<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/judge.php";

$json = json_read();
$username = compulsory_param($json->username);

check_judge_exists($username, true);
delete_judge($username);

json_write(200, "Akaun hakim '" . $username . "' telah dihapuskan.");
