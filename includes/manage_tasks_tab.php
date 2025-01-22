<div id="managetasks" class="tab-pane fade in <?php if ($activeTab === "managetasks") echo 'active'; ?>">
    <div class="row m-b-20 new-button">
        <div class="col-md-12">
            <div class="pull-right">
                <button type="button" class="btn btn-primary waves-effect waves-light new-task-btn"><i class="fa fa-plus"></i> Add New Task</button>
            </div>
        </div>
    </div>
    <!-- Created Tasks -->
    <script>
        function changePublishedStatus(id, newStatus) {
            if (!confirm('Are you sure you want to ' + newStatus + ' this task?')) {
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
            action.value = 'change_published_status';
            form.appendChild(action);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
    <?php if (count($tasks)): ?>
        <div class="row created-tasks">
            <?php foreach ($tasks as $i => $task): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="panel" style="cursor: pointer;">
                        <div class="panel-header">
                            <?php $date_props = format_task_date($task->due_date); ?>
                            <div class="due-date <?= $date_props['overdue'] ? 'overdue' : '' ?> text-center pull-right"><?= $date_props['day'] ?><br><?= $date_props['month'] ?><?= $date_props['overdue'] ? '<br/><small><strong>Overdue</strong></small>' : '' ?> </div>
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
                                <button data-toggle="tooltip" type="button" id="" title="Edit" class="btn btn icon-btn edit-task-btn" data-id="<?= $task->id ?>">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>
                            <div class="icon-links quick-icon-links">
                                <button onclick="changePublishedStatus(<?= $task->id ?>, '<?= $task->published ? 'unpublish' : 'publish' ?>')" data-toggle="tooltip" type="button" id="" title="<?= $task->published ? "Unpublish" : "Publish" ?>" class="btn btn icon-btn">
                                    <i class="fa fa-toggle-<?= $task->published ? "on" : "off" ?>"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No tasks yet!</p>
    <?php endif; ?>
    <!-- end Created Tasks -->

    <?php foreach ($tasks as $task): ?>
        <div class="row edit-task_panel" data-id="<?= $task->id ?>" style="display: none;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-plus"></i> Edit Task</h4>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="task_process.php">
                        <div class="form-group">
                            <label class="control-label">Task Name</label>
                            <input name="name" value="<?= $task->name ?>" required type="text" class="form-control" placeholder="Some text value...">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="description" required minlength="10" class="form-control" rows="5"><?= $task->description ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="col-md-4">Due Date</label>
                                <div class="input-group col-md-8">
                                    <input name="due_date" value="<?= $task->due_date ?>" required type="text" class="form-control date-input" placeholder="mm/dd/yyyy" id="datepicker">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $task->id ?>">
                        <div class="col-md-6">
                            <div class="pull-right">
                                <div role="button" class="cancel-btn btn btn-secondary waves-effect waves-light">Cancel</div>
                                <button type="submit" name="action" value="update" class="create-btn btn btn-primary waves-effect waves-light">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- New Tasks -->
    <div class="row new-task_panel" style="display: none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><i class="fa fa-plus"></i> New Task</h4>
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="task_process.php">
                    <div class="form-group">
                        <label class="control-label">Task Name</label>
                        <input name="name" required type="text" class="form-control" placeholder="Some text value...">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea name="description" required minlength="10" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-4">Due Date</label>
                            <div class="input-group col-md-8">
                                <input name="due_date" required type="text" class="form-control date-input" placeholder="mm/dd/yyyy" id="datepicker">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <div role="button" class="cancel-btn btn btn-secondary waves-effect waves-light">Cancel</div>
                            <button type="submit" name="action" value="create" class="create-btn btn btn-primary waves-effect waves-light">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end New Tasks -->
</div>