<?php

require_once __DIR__ . '/../Database.php';

class Task
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public string $due_date,
        public int $user,
        public bool $completed,
        public bool $published,
    ) {}

    public static function width_data(array $data): Task
    {
        return new Task(
            $data['id'] ?? 0,
            $data['name'] ?? '',
            $data['description'] ?? '',
            $data['due_date'] ?? '',
            $data['user'] ?? 0,
            !is_null($data['completed']) ? $data['completed'] === 1 : false,
            !is_null($data['published']) ? $data['published'] === 1 : true
        );
    }

    public static function get_all(): array
    {
        $db = Database::get_conn();
        $sql = "SELECT * FROM tasks";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll();
        return array_map(function ($item) {
            return Task::width_data($item);
        }, $items);
    }

    public static function add(Task $task)
    {
        $db = Database::get_conn();
        $sql = "INSERT INTO tasks (name, description, due_date, user) VALUES (:name, :description, :due_date, :user)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'name' => $task->name,
            'description' => $task->description,
            'due_date' => $task->due_date,
            'user' => $task->user,
        ]);
    }

    public static function get_by_id(int $id): Task|null
    {
        $db = Database::get_conn();
        $stmt = $db->prepare('SELECT * FROM tasks WHERE id = :id');
        $success = $stmt->execute(['id' => $id]);
        if (!$success) {
            return null;
        }
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return Task::width_data($data);
    }

    public static function update(Task $task)
    {
        $db = Database::get_conn();
        $sql = "UPDATE tasks SET name=:name,description=:description,due_date=:due_date,completed=:completed,published=:published WHERE id=:id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'name' => $task->name,
            'description' => $task->description,
            'due_date' => $task->due_date,
            'completed' => $task->completed ? 1 : 0,
            'published' => $task->published ? 1 : 0,
            'id' => $task->id,
        ]);
    }

    public static function mark_all_completed()
    {
        $db = Database::get_conn();
        $sql = "UPDATE tasks SET completed=1";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }

    public static function delete_all_completed()
    {
        $db = Database::get_conn();
        $sql = "DELETE FROM tasks WHERE completed=1 AND published=1";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }

    public static function delete_one(int $id)
    {
        $db = Database::get_conn();
        $sql = "DELETE FROM tasks WHERE id=:id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}
