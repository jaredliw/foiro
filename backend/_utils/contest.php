<?php
require_once __DIR__ . "/database.php";

function check_contest_exists(string $id, bool $expect_to_be): void
{
    $stmt = MySQL::connection()->prepare("
        SELECT id
        FROM   contest
        WHERE  id = ?;
    ");
    $stmt->bind_param("s", $id);
    $stmt->execute();

    if ($expect_to_be xor $stmt->get_result()->num_rows !== 0) {
        json_write(
            $expect_to_be ? 404 : 409,
            'Pertandingan dengan kod \'' .
            htmlspecialchars($id) .
            '\' ' .
            ($expect_to_be ? "tidak" : "telah") .
            " wujud dalam pangkalan data."
        );
    }
}

function fetch_all_contests(): array
{
    # Return all schools
    $stmt = MySQL::connection()->prepare("
        SELECT id,
               name,
               start_date,
               end_date
        FROM   contest;
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function delete_contest($id): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM contest
        WHERE  id = ?;
    ");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
