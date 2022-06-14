<?php
function sql_sanitize(string $string): string
{
    require __DIR__ . "/database.php";
    /** @noinspection PhpUndefinedVariableInspection */
    return mysqli_real_escape_string($MYSQL_CONNECTION, $string);
}
