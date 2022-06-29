<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("student", "admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/contest.php";

$contests =
    $_SESSION["role"] === "student"
        ? fetch_contests_participated_by_student($_SESSION["username"])
        : fetch_all_contests();

json_write(200, "Berjaya.", $contests);
