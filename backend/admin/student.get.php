<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/student.php";

$students = fetch_all_students();

json_write(200, "Berjaya.", $students);
