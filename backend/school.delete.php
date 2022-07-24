<?php
require_once __DIR__ . "/_utils/security.php";
check_access("admin");

require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/school.php";

$json = json_read();
$school_code = compulsory_param(@$json->code);

check_school_exists($school_code, true);
delete_school($school_code);

json_write(200, "Sekolah dengan kod '" . $school_code . "' telah dihapuskan.");
