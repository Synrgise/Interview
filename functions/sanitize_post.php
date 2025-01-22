<?php

function sanitize_post(array $post): array
{
    $sanitized = [];
    foreach ($post as $key => $value) {
        if (is_array($value)) {
            $sanitized[$key] = sanitize_post($value);
        } else {
            $sanitized[$key] = htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
        }
    }
    return $sanitized;
}
