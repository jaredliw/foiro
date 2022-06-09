<?php
require __DIR__ . '/credentials.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  // todo: remove this line in prod mode
/** @noinspection PhpUndefinedVariableInspection */
$MYSQL_CONNECTION = mysqli_connect(
    $MYSQL_HOSTNAME,
    $MYSQL_USERNAME,
    $MYSQL_PASSWORD,
    $MYSQL_DATABASE
);
