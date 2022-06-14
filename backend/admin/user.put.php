<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/user.php";

$json = json_read();
$username = compulsory_param($json->username);
$name = compulsory_param($json->name);
$raw_password = compulsory_param($json->password);
$role = compulsory_param($json->role);

if (!preg_match('/^[a-z\d_]{3,20}$/i', $username)) {
    json_write(400, "Nama pengguna tidak sah.");
}
if ($name === "") {
    json_write(400, "Nama tidak sah.");
}
if (
    $raw_password !== "" &&
    !preg_match(
        '/^[a-zA-Z\d .,\/<>?;:"\'`~!@#$%^&*()\[\]{}_+=|\\-]{8,}$/',
        $raw_password
    )
) {
    json_write(400, "Kata laluan tidak sah.");
}
if (!in_array($role, ["student", "teacher", "admin"])) {
    json_write(400, "Peranan akaun tidak sah.");
}

check_user_exists($username, true);
update_user_info($username, $name, $role);

if ($raw_password !== "") {
    $password = hash_password($raw_password);
    change_password($username, $password);
}

json_write(200, "Akaun '" . $username . "' telah dikemas kini.");
