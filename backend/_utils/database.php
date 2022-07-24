<?php
require __DIR__ . "/credentials.php";

class MySQL
{
    private static $connection;

    public static function sanitize(string $string): string
    {
        return mysqli_real_escape_string(self::connection(), $string);
    }

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
}
