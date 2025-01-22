<?php

require_once "./guards/method_guard.php";
method_guard('./', 'POST');

require_once "./guards/auth_required_guard.php";
auth_required_guard('./login');

require_once "./functions/sanitize_post.php";

$action = $_POST['action'];

require_once "./database/models/Task.php";
require_once "./functions/redirect_with_error.php";

function create()
{
    $post_data = sanitize_post($_POST);
    try {
        $name = $post_data['name'];
        $description = $post_data['description'];
        $due_date = $post_data['due_date'];
        $user = $_SESSION['user']['id'];
        Task::add(Task::width_data([
            'name' => $name,
            'description' => $description,
            'due_date' => $due_date,
            'user' => $user,
        ]));
        header('Location: /?tab=managetasks');
    } catch (\Throwable $th) {
        redirect_with_error("./?tab=managetasks", $th);
    }
}

function mark_one_completed()
{
    try {
        $post_data = sanitize_post($_POST);
        $id = $post_data['id'];
        $task = Task::get_by_id($id);
        if (!$task) {
            throw new Exception("Task not found!!!");
        }
        $task->completed = true;
        Task::update($task);
        header('Location: /');
    } catch (\Throwable $th) {
        redirect_with_error("./", $th);
    }
}

function mark_all_completed()
{
    try {
        Task::mark_all_completed();
        header('Location: /');
    } catch (\Throwable $th) {
        redirect_with_error("./", $th);
    }
}

function delete_all_completed()
{
    try {
        Task::delete_all_completed();
        header('Location: /?tab=managetasks');
    } catch (\Throwable $th) {
        redirect_with_error("./?tab=completedtasks", $th);
    }
}

function delete_one()
{
    try {
        $post_data = sanitize_post($_POST);
        $id = $post_data['id'];
        Task::delete_one($id);
        header('Location: /?tab=completedtasks');
    } catch (\Throwable $th) {
        redirect_with_error("./?tab=completedtasks", $th);
    }
}

function change_published_status()
{
    try {
        $post_data = sanitize_post($_POST);
        $id = $post_data['id'];
        $task = Task::get_by_id($id);
        if (!$task) {
            throw new Exception("Task not found!!!");
        }
        $task->published = !$task->published;
        Task::update($task);
        header('Location: /?tab=managetasks');
    } catch (\Throwable $th) {
        redirect_with_error("./?tab=managetasks", $th);
    }
}

function update()
{
    $post_data = sanitize_post($_POST);
    try {
        $id = $post_data['id'];
        $task = Task::get_by_id($id);
        if (!$task) {
            throw new Exception("Task not found!!!");
        }
        $name = $post_data['name'];
        $description = $post_data['description'];
        $due_date = $post_data['due_date'];
        $task->name = $name;
        $task->description = $description;
        $task->due_date = $due_date;
        Task::update($task);
        header('Location: /?tab=managetasks');
    } catch (\Throwable $th) {
        redirect_with_error("./?tab=managetasks", $th);
    }
}

switch ($action) {
    case 'create':
        create();
        break;
    case 'mark_one_completed':
        mark_one_completed();
        break;
    case 'mark_all_completed':
        mark_all_completed();
        break;
    case 'delete_all_completed':
        delete_all_completed();
        break;
    case 'delete_one':
        delete_one();
        break;
    case 'change_published_status':
        change_published_status();
        break;
    case 'update':
        update();
        break;
}
