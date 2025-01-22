<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../functions/redirect_with_error.php";

function auth_required_guard(string $redirect_url): void
{
    $user =  $_SESSION['user'] ?? null;
    if (!$user) {
        redirect_with_error($redirect_url, "You must be logged in to access this page!!!");
    }
}
