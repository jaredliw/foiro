<?php
function user_dispatch(string $privilege): ?string
{
    # Return redirect url, null if it is not recognized
    switch ($privilege) {
        case "student":
            return "/student/student";
        case "judge":
            return "/judge/judge";
        case "admin":
            return "/admin/student";
        default:
            return null;
    }
}

function hash_password(string $password): string
{
    # SHA512 hash the password
    return hash("sha512", $password);
}

function logout(): void
{
    session_start();
    session_unset();
    session_destroy();
}
