<?php
function sql_sanitize(string $string): string
{
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  // todo: remove this line in prod mode

require_once __DIR__ . '/credentials.php';
/** @noinspection PhpUndefinedVariableInspection */
$MYSQL_CONNECTION = mysqli_connect(
    $MYSQL_HOSTNAME,
    $MYSQL_USERNAME,
    $MYSQL_PASSWORD,
    $MYSQL_DATABASE
);
