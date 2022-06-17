<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/judge.php";

$judges = fetch_all_judges();

json_write(200, "Berjaya.", $judges);
