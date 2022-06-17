<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/contest.php";

$contests = fetch_all_contests();

json_write(200, "Berjaya.", $contests);
