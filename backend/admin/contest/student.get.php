<?php
require_once __DIR__ . "/../../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../../_utils/io.php";
require_once __DIR__ . "/../../_utils/student_registration.php";
require_once __DIR__ . "/../../_utils/validate.php";

$contest_id = compulsory_param(@$_GET["contest_id"]);
validate_contest_id($contest_id);
$results = get_students_of_contest($contest_id);

json_write(200, "Berjaya.", $results);
