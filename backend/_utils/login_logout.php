<?php
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
