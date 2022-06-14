<?php
require_once __DIR__ . "/_utils/database.php";
require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/user.php";

session_start();
$my_username = $_SESSION["username"];
if ($my_username) {
    json_write(403, "Sila log masuk terlebih dahulu.");
}

$user = search_user_on_username($my_username);
if (is_null($user)) {
    logout();
    json_write(401, "Sesi pelanggan tamat. Sila log masuk semula.");
}

json_write(200, "Berjaya.", [
    "username" => $user["username"],
    "name" => $user["name"],
    "role" => $user["role"],
]);
