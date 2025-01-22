<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../functions/redirect_with_error.php";

function method_guard(string $redirect_url, string $method): void
{
    if ($_SERVER['REQUEST_METHOD'] !== $method) {
        redirect_with_error($redirect_url, "Invalid request method");
    }
}
