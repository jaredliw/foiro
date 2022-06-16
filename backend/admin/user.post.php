<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/user.php";

$json = json_read();
$username = compulsory_param($json->username);
$name = compulsory_param($json->name);
$raw_password = compulsory_param($json->password);
$gender = compulsory_param($json->gender);
$role = compulsory_param($json->role);

// todo: stricter check
if (!preg_match('/^[a-z\d_]{3,20}$/i', $username)) {
    json_write(400, "Nama pengguna tidak sah.");
}
if ($name === "") {
    json_write(400, "Nama tidak sah.");
}
if (
    !preg_match(
        '/^[a-zA-Z\d .,\/<>?;:"\'`~!@#$%^&*()\[\]{}_+=|\\-]{8,}$/',
        $raw_password
    )
) {
    json_write(400, "Kata laluan tidak sah.");
}
if (!in_array($gender, ["M", "F"])) {
    json_write(400, "Jantina tidak sah.");
}
if (!in_array($role, ["student", "judge", "admin"])) {
    json_write(400, "Peranan akaun tidak sah.");
}

check_user_exists($username, false);
$password = hash_password($raw_password);
add_new_user($username, $name, $gender, $password, $role);

json_write(201, "Akaun '" . $username . "' telah dicipta.");
