<?php
require_once __DIR__ . "/io.php";
require_once __DIR__ . "/database.php";

function get_judge_profile(string $username): ?array
{
    $stmt = MySQL::connection()->prepare("
        SELECT username,
               name
        FROM   judge
        WHERE  username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function search_judge_on_username_and_password(
    string $username,
    string $password
): ?array
{
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM   judge
        WHERE  username = ?
               AND password = ?;
    ");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function fetch_all_judges(): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT    j.username,
                  j.name,
                  COUNT(jcl.contest_id) AS involved_count
        FROM      judge AS j
        LEFT JOIN judge_contest_lnk AS jcl
        ON        j.username = jcl.judge_username
        GROUP BY  j.username
        ORDER BY  j.username;
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function check_judge_exists(string $username, bool $expect_to_be): void
{
    $stmt = MySQL::connection()->prepare("
        SELECT username
        FROM   judge
        WHERE  username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    if ($expect_to_be xor $stmt->get_result()->num_rows !== 0) {
        json_write(
            $expect_to_be ? 404 : 409,
            'Nama pengguna hakim \'' .
            htmlspecialchars($username) .
            '\' ' .
            ($expect_to_be ? "tidak" : "telah") .
            " wujud dalam pangkalan data."
        );
    }
}

function add_new_judge(
    string $username,
    string $name,
    string $password
): void
{
    $stmt = MySQL::connection()->prepare("
        INSERT INTO judge
                    (username,
                     name,
                     password)
        VALUES      (?,
                     ?,
                     ?);
    ");
    $stmt->bind_param("sss", $username, $name, $password);
    $stmt->execute();
}

function update_judge_info(string $username, string $name): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE judge
        SET    name = ?
        WHERE  username = ?; 
    ");
    $stmt->bind_param("ss", $name, $username);
    $stmt->execute();
}

function change_judge_password(string $username, string $password): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE judge
        SET    password = ?
        WHERE  username = ?;
    ");
    $stmt->bind_param("ss", $password, $username);
    $stmt->execute();
}

function delete_judge(string $username): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM judge
        WHERE  username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
}
