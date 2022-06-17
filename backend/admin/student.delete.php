<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/student.php";

$json = json_read();
$username = compulsory_param($json->username);

check_student_exists($username, true);
delete_student($username);

json_write(200, "Akaun pelajar '" . $username . "' telah dihapuskan.");
