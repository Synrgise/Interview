<?php

require_once "../guards/method_guard.php";
method_guard('./', 'POST');

require_once "../guards/auth_not_required_guard.php";
auth_not_required_guard('/');

require_once "../functions/sanitize_post.php";
$post_data = sanitize_post($_POST);

$username = $post_data['username'];
$password = $post_data['password'];

require_once "../database/models/User.php";

require_once "../functions/redirect_with_error.php";

try {
    $user = User::get_by_username($username);
    if (!$user) {
        throw new Exception("Invalid username!!!");
    }

    if (!$user->verify_password($password)) {
        throw new Exception("Invalid password!!!");
    }

    $_SESSION['user'] = (array) $user;

    header('Location: /?tab=managetasks');
} catch (\Throwable $th) {
    redirect_with_error("./", $th);
}
