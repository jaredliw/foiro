<?php
require_once __DIR__ . "/../_utils/database.php";

function get_students_of_contest($contest_id): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT    sc.student_username AS username,
                  s.name
        FROM      student_contest_lnk sc
        LEFT JOIN student s
        ON        sc.student_username = s.username
        WHERE     sc.contest_id = ?;
    ");
    $stmt->bind_param("i", $contest_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function register_student_to_contest($student_username, $contest_id)
{
    $stmt = MySQL::connection()->prepare("
        INSERT INTO student_contest_lnk
                    (student_username,
                     contest_id)
        VALUES      (?,
                     ?);
    ");
    $stmt->bind_param("si", $student_username, $contest_id);
    $stmt->execute();
}

function get_student_registration(string $student_username): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT contest_id
        FROM   student_contest_lnk
        WHERE  student_username = ?;
    ");
    $stmt->bind_param("s", $student_username);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function unregister_student_from_contest(string $student_username, $contest_id): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM student_contest_lnk
        WHERE  student_username = ?
               AND contest_id = ?; 
    ");
    $stmt->bind_param("si", $student_username, $contest_id);
    $stmt->execute();
}
