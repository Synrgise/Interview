<?php

require_once __DIR__ . "/../database/models/Task.php";

function render_task_card(Task $task, string $bottom_bar_content = "")
{
    $date = new DateTime($task->due_date);
    $day = $date->format('d');
    $month = $date->format('M');
    echo '<div class="col-sm-6 col-md-4">
                <div class="panel" style="cursor: pointer;">
                    <div class="panel-header">
                        <div class="due-date text-center pull-right">' . $day . '<br>' . $month . '</div>
                    </div>
                    <div class="panel-body">
                        <div class="panel-inner">
                            <div class="panel-inner-content">
                                <h3>' . $task->name . '</h3>
                                <p>' . $task->name . '</p>
                            </div>
                        </div>
                    </div>';
    if ($bottom_bar_content !== "") {
        echo $bottom_bar_content;
    }

    echo '</div>
            </div>';
}
