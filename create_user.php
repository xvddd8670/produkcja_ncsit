<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>form</title>
</head>
<body>

<form method="post" action="create_user.php">
    <input type="text" name="user" placeholder="user" required><br>
    <input type="text" name="password" placeholder="password" required><br>
    <input type="text" name="user_group" placeholder="group" required><br>
    <button type="submit">create user</button>
</form>

<?php
require_once 'sqlite_helper.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $db = new SQLiteManager('users.db');
} catch (Exception $e) {
     "error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$user = $_POST['user'] ?? '';
$password = $_POST['password'] ?? '';
#$password = password_hash($password, PASSWORD_DEFAULT);
$user_group = $_POST['user_group'] ?? '';

$db->insert('users',
    ['user' => $user,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'user_group' => $user_group
]);

?>
</body>
