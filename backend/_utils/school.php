<?php
require_once __DIR__ . "/database.php";

function fetch_all_schools(): array
{
    # Return all schools
    $stmt = MySQL::connection()->prepare("
        SELECT s.code,
               s.name,
               COUNT(u.username) AS student_count
        FROM   school s
               LEFT JOIN (SELECT username,
                                 school
                          FROM   user
                          WHERE  user.role = 'student') u
                      ON u.school = s.code
        GROUP  BY s.code; 
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
