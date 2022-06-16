<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/user.php";

$all_users = fetch_all_users();

$records = [];
foreach ($all_users as $user) {
    $formatted = [
        "username" => $user["username"],
        "name" => $user["name"],
        "gender" => $user["gender"] == "M" ? "L" : "P",
        "role" => $user["role"],
    ];
    $records[] = $formatted;
}

json_write(200, "Berjaya.", $records);
