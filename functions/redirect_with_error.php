<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function redirect_with_error(string $redirect_url, \Throwable|string $e)
{
    if ($e instanceof \Throwable) {
        $error = $e->getMessage();
    } else {
        $error = $e;
    }

    $_SESSION['error'] = $error;
    header('Location: ' . $redirect_url);
    exit;
}
