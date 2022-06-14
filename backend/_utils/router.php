<?php
require_once __DIR__ . "/json.php";

$routes = [];

function route(string $paths, callable $callback = null): void
{
    if (is_null($callback)) {
        // Use default callback
        $callback = function ($uri) {
            /** @noinspection PhpIncludeInspection */
            require_once __DIR__ . "/../" . $uri . ".php";
            return true;
        };
    }

    global $routes;
    // Multiple paths are split by spaces
    foreach (explode(" ", $paths) as $path) {
        if (isset($routes[$path])) {
            error_log("Duplicate route: " . $path . ", taking the last one.");
        }
        $routes[$path] = $callback;
    }
}

function run(): void
{
    global $routes;
    $uri = $_SERVER["REQUEST_URI"];
    $uri = substr(
        $uri,
        0,
        !strpos($uri, "?") ? strlen($uri) : strpos($uri, "?")
    ); // remove everything after ?

    $found = false;
    foreach ($routes as $pattern => $callback) {
        if ($uri == $pattern) {
            $success = $callback($uri);
            if ($success) {
                $found = true;
                break;
            }
        }
    }

    if (!$found) {
        response(404, "Halaman tidak ditemui.");
    }
}
