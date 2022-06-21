<?php
require_once __DIR__ . "/../_utils/database.php";

function get_results($contest_id): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT    RANK() OVER (ORDER BY SUM(r.score) DESC) AS `rank`,
                  s.username,
                  s.name,
                  s.school AS school_code,
                  s2.name  AS school_name
        FROM      result   AS r
        LEFT JOIN student  AS s
        ON        student_username = username
        LEFT JOIN school s2
        ON        s.school = s2.code
        WHERE     r.contest_id = ?
        GROUP BY  s.username
        ORDER BY  `rank`;
    ");
    $stmt->bind_param("i", $contest_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
