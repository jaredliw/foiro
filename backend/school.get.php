<?php
require_once __DIR__ . "/_utils/security.php";
check_access("admin");

require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/school.php";

$schools = fetch_all_schools();

json_write(200, "Berjaya.", $schools);
