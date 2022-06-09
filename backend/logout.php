<?php
require_once __DIR__ . '/_utils/json.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();
    session_unset();
    session_destroy();
    response(200, 'Log keluar berjaya.');
} else {
    response(405, 'Kaedah tidak dibenarkan.');
}
