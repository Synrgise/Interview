<?php

$completed_tasks = array_filter($tasks, function ($t) {
    return $t->completed && $t->published;
});
?>

<div id="completedtasks" class="tab-pane fade in <?php if ($activeTab === "completedtasks") echo 'active'; ?>">
    <?php if (count($completed_tasks)): ?>
        <div class="row m-b-20">
            <div class="col-md-12">
                <div class="pull-right">
                    <div class="icon-links quick-icon-links">
                        <button data-toggle="tooltip" type="button" id="block-view" title="Block view" class="btn btn icon-btn">
                            <i class="block-view fa fa-th-large text-primary"></i>
                        </button>
                    </div>
                    <div class="icon-links quick-icon-links" style="margin-right: 20px;">
                        <button data-toggle="tooltip" type="button" id="list-view" title="List view" class="btn btn icon-btn">
                            <i class="list-view fa fa-th-list"></i>
                        </button>
                    </div>
                    <button type="button" class="btn dropdown-toggle btn-primary waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="md md-file-download"></i> Export</button>
                    <ul class="dropdown-menu" role="menu" style="right: 30px;">
                        <li><a href="/export.php?type=pdf" download="completed_tasks.pdf">PDF</a></li>
                        <li><a href="/export.php?type=csv" download="completed_tasks.csv">Excel CSV</a></li>
                    </ul>
                    <script>
                        const deleteAll = () => {
                            if (!confirm('Are you sure you want to delete all completed tasks?')) {
                                return;
                            }
                            const form = document.createElement('form');
                            form.method = 'post';
                            form.action = './task_process.php';
                            const action = document.createElement('input');
                            action.type = 'hidden';
                            action.name = 'action';
                            action.value = 'delete_all_completed';
                            form.appendChild(action);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    </script>
                    <button onclick="deleteAll()" type="button" class="btn btn-default waves-effect waves-light"> Delete All</button>
                </div>
            </div>
        </div>
        <script>
            const deleteOne = (id) => {
                if (!confirm('Are you sure you want to delete this task?')) {
                    return;
                }
                const form = document.createElement('form');
                form.method = 'post';
                form.action = './task_process.php';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = id;
                form.appendChild(input);
                const action = document.createElement('input');
                action.type = 'hidden';
                action.name = 'action';
                action.value = 'delete_one';
                form.appendChild(action);
                document.body.appendChild(form);
                form.submit();
            }
        </script>
        <div class="row completed-blocks">
            <?php foreach ($completed_tasks as $task): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="panel" style="cursor: pointer;">
                        <div class="panel-header">
                            <?php $date_props = format_task_date($task->due_date); ?>
                            <div class="due-date <?= $date_props['overdue'] ? 'overdue' : '' ?> text-center pull-right"><?= $date_props['day'] ?><br><?= $date_props['month'] ?><?= $date_props['overdue'] ? '<br/><small><strong>overdue</strong></small>' : '' ?> </div>
                        </div>
                        <div class="panel-body">
                            <div class="panel-inner">
                                <div class="panel-inner-content">
                                    <h3><?= $task->name ?></h3>
                                    <p><?= $task->description ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer" style="padding: 0;text-align: right;">
                            <div class="icon-links quick-icon-links">
                                <button onclick="deleteOne(<?= $task->id ?>)" data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row completed-list" style="display: none;">
            <table id="" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Due Date</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($completed_tasks as $task): ?>
                        <tr>
                            <?php $date_props = format_task_date($task->due_date); ?>
                            <td><?= $date_props['day'] ?> <?= $date_props['month'] ?><?= $date_props['overdue'] ? ' (<small><strong>Overdue</strong></small>)' : '' ?></td>
                            <td><?= $task->name; ?></td>
                            <td><?= $task->description; ?></td>
                            <td class="icon-links quick-icon-links">
                                <button onclick="deleteOne(<?= $task->id ?>)" data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No completed tasks!</p>
    <?php endif; ?>
</div>