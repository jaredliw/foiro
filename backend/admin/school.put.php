<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/school.php";
require_once __DIR__ . "/../_utils/validate.php";
require_once __DIR__ . "/../_utils/login_logout.php";

// Read
$json = json_read();
$code = compulsory_param(@$json->code);
$name = compulsory_param(@$json->name);

// Check
validate_school_code($code);
validate_general_name($name);
check_school_exists($code, true);

// Add
update_school_info($code, $name);

json_write(200, "Maklumat sekolah '" . $code . "' telah dikemas kini.");
