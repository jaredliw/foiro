<?php
require_once __DIR__ . "/../_utils/database.php";

function get_results($contest_id): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT    RANK() OVER (ORDER BY SUM(r.score) DESC) AS `rank`,    
                  scl.student_username AS username,
                  s.name,
                  s.school AS school_code,
                  sc.name AS school_name
        FROM      student_contest_lnk AS scl
        NATURAL LEFT JOIN result AS r
        LEFT JOIN student AS s
        ON        scl.student_username = s.username
        LEFT JOIN school AS sc
        ON        s.school = sc.code
        WHERE     contest_id = ?
        GROUP BY  student_username;
    ");
    $stmt->bind_param("i", $contest_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
