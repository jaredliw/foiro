<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("judge");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/validate.php";
require_once __DIR__ . "/../_utils/result.php";

$contest_id = compulsory_param(@$_GET["contest_id"]);
validate_contest_id($contest_id);
$contest_id = (int)$contest_id;

if ($_SESSION['role'] === "admin") {
    $results = get_score($contest_id);
} else {
    $results = get_score($contest_id, $_SESSION["username"]);
}
json_write(200, "Berjaya.", $results);
