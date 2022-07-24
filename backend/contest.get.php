<?php
require_once __DIR__ . "/_utils/security.php";
check_access("student", "judge", "admin");

require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/contest.php";

switch ($_SESSION["role"]) {
    case "admin":
        $contests = fetch_all_contests();
        break;
    case "judge":
        $contests = fetch_contests_participated_by_judge($_SESSION["username"]);
        break;
    default:
        $contests = fetch_contests_participated_by_student($_SESSION["username"]);
}

json_write(200, "Berjaya.", $contests);
