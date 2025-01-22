<?php

require_once __DIR__ . '/../Database.php';

class User
{
    public function __construct(public int $id, public string $username, private string $password) {}

    public static function width_data(array $data): User
    {
        return new User($data['id'] ?? 0, $data['username'] ?? '', $data['password'] ?? '');
    }

    public function verify_password(string $password): bool
    {
        // TODO: use password_hash and password_verify
        return $password === $this->password;
    }

    public static function get_by_username(string $username): User|null
    {
        $db = Database::get_conn();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $success = $stmt->execute(['username' => $username]);
        if (!$success) {
            return null;
        }
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return User::width_data($data);
    }
}
