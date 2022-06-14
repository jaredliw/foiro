<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/user.php";

$json = json_read();
$username = compulsory_param($json->username);

check_user_exists($username, true);
delete_user($username);

json_write(200, "Akaun '" . $username . "' telah dihapuskan.");
