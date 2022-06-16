<?php
require_once __DIR__ . "/database.php";

function fetch_all_schools(): array
{
    # Return all schools
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM school;
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
