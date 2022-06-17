<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/user.php";

$users = fetch_all_users();

json_write(200, "Berjaya.", $users);
