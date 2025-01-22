<?php

function format_task_date(string $date): array
{
    $date = new DateTime($date);
    return [
        'day' => $date->format('d'),
        'month' => $date->format('M'),
        'overdue' => new DateTime() > $date
    ];
}
