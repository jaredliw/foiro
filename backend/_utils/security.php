<?php
function check_access($role_required): void
{
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] === $role_required) {
        return;
    }

    require_once __DIR__ . '/json.php';
    response(401, 'Permisi tidak diberikan.');
    exit;
}
