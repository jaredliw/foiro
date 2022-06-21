<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/judge_registration.php";
require_once __DIR__ . "/../_utils/validate.php";

$contest_id = compulsory_param(@$_GET["contest_id"]);
validate_contest_id($contest_id);
$results = get_judge_registration($contest_id);

json_write(200, "Berjaya.", $results);
