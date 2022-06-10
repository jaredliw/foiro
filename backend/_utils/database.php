<?php
require __DIR__ . '/credentials.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  // todo: remove this line in prod mode

class MySQL
{
    private static $connection;

    public static function connection()
    {
        if (is_null(self::$connection)) {
            self::$connection = mysqli_connect(
                MYSQL_HOSTNAME,
                MYSQL_USERNAME,
                MYSQL_PASSWORD,
                MYSQL_DATABASE
            );
        }

        return self::$connection;
    }

    public static function sanitize(string $string): string
    {
        return mysqli_real_escape_string(self::connection(), $string);
    }
}
