<?php
require_once __DIR__ . "/_utils/database.php";
require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/login_logout.php";

session_start();

$json = json_read();
$username = compulsory_param($json->username);
$raw_password = compulsory_param($json->password);
$remember = isset($json->remember) && $json->remember === "on"; // todo, remember me

$user = search_user_on_username_and_password(
    $username,
    hash_password($raw_password)
);
if ($user === null) {
    json_write(403, "Nama pengguna atau kata laluan tidak sah.");
}

$role = $user["role"];
$redirect_url = user_dispatch($role);
if ($redirect_url === null) {
    /** @noinspection PhpUnhandledExceptionInspection */
    throw new Exception("Unrecognized role: " . $role . "."); // Error handler is set in app.php
}

$_SESSION["username"] = $username;
$_SESSION["role"] = $role;
json_write(200, "Log masuk berjaya.", [
    "redirect_url" => $redirect_url,
]);
