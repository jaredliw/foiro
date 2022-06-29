<?php
function check_access(string ...$role_required): void
{
    session_start();
    if (isset($_SESSION["role"]) && in_array($_SESSION["role"], $role_required)) {
        return;
    }

    require_once __DIR__ . "/io.php";
    json_write(401, "Permisi tidak diberikan.");
    exit();
}
