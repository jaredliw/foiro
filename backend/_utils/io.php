<?php
function compulsory_param(?string $param): string
{
    # Make sure the parameter is not null, throw 400 error if it is
    if ($param === null) {
        json_write(400, "Parameter wajib tidak dibekalkan.");
    }
    return $param;
}

function json_read()
{
    // Read json input
    return json_decode(file_get_contents("php://input"));
}

function json_write(
    int $status_code,
    string $message,
    ?array $data = null
): void {
    header("Content-Type: application/json; charset=utf-8");
    http_response_code($status_code);
    $arr = [
        "status_code" => $status_code,
        "message" => $message,
    ];
    if ($data !== null) {
        $arr["data"] = $data;
    }
    echo json_encode($arr);
    exit();
}
