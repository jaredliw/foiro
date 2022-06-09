<?php
function response(int $status_code, string $message, ?array $data = null): void
{
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status_code);
    $arr = [
        'status_code' => $status_code,
        'message' => $message
    ];
    if ($data !== null) {
        $arr['data'] = $data;
    }
    echo json_encode($arr);
    exit;
}
