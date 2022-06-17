<?php
require_once __DIR__ . "/database.php";

function fetch_all_contests(): array
{
    # Return all schools
    $stmt = MySQL::connection()->prepare("
        SELECT id, `name`, start_date, end_date
        FROM contest
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
