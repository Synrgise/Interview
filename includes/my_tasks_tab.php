<?php
$uncompleted_tasks = array_filter($tasks, function ($t) {
    return !$t->completed && $t->published;
});
?>

<script>
    function updateTaskStatus(taskId) {
        const form = document.createElement('form');
        form.method = 'post';
        form.action = './task_process.php';
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id';
        input.value = taskId;
        form.appendChild(input);
        const action = document.createElement('input');
        action.type = 'hidden';
        action.name = 'action';
        action.value = 'mark_one_completed';
        form.appendChild(action);
        document.body.appendChild(form);
        form.submit();
    }
</script>

<div id="mytasks" class="tab-pane fade in <?php if ($activeTab === "mytasks") echo 'active'; ?>">
    <?php if (count($uncompleted_tasks)): ?>
        <div class="row m-b-20">
            <div class="col-md-12">
                <form action="./task_process.php" method="post" class="pull-right">
                    <button name="action" value="mark_all_completed" type="submit" class="btn btn-primary waves-effect waves-light">Mark as complete</button>
                </form>
            </div>
        </div>
        <div class="row">
            <?php foreach ($uncompleted_tasks as $i => $task): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="panel panel-danger" style="cursor: pointer;">
                        <div class="panel-header">
                            <?php $date_props = format_task_date($task->due_date); ?>
                            <div class="due-date <?= $date_props['overdue'] ? 'overdue' : '' ?> text-center pull-right"><?= $date_props['day'] ?><br><?= $date_props['month'] ?><?= $date_props['overdue'] ? '<br/><small><strong>overdue</strong></small>' : '' ?> </div>
                            <div class="checkbox checkbox-primary">
                                <input title="Complete this task" class="todo-done" id="1" type="checkbox" onchange="updateTaskStatus(<?= $task->id ?>)">
                                <label for="1"></label>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="panel-inner">
                                <div class="panel-inner-content">
                                    <h3><?= $task->name ?></h3>
                                    <p><?= $task->description ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">All done!</p>
    <?php endif; ?>
</div>