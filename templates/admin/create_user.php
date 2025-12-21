<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/sqlite_helper.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $db = new SQLiteManager($_SERVER['DOCUMENT_ROOT'] . '/users.db');
} catch (Exception $e) {
     "error: " . $e->getMessage();
}

$user = $_POST['user'] ?? '';
$password = $_POST['password'] ?? '';
#$password = password_hash($password, PASSWORD_DEFAULT);
$user_group = $_POST['user_group'] ?? '';
$workplace = $_POST['workplace'] ?? '';

$db->insert('users',
    ['user' => $user,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'user_group' => $user_group,
    'workplace' => $workplace
]);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>form</title>
</head>
<body>

<form method="post" action="">
    <input type="text" name="user" placeholder="user" required><br>
    <input type="text" name="password" placeholder="password" required><br>
    <select name="user_group" required>
        <option value=" ">group</option>
        <option value="admin">admin</option>
        <option value="manager">manager</option>
        <option value="leader">leader</option>
        <option value="worker">worker</option>
    </select><br>
    <select name="workplace" required>
        <option value=" ">workplace</option>
        <option value="operator">operator</option>
        <option value="assembler">assembler</option>
        <option value="packer">packer</option>
        <option value="painter">painter</option>
    </select><br>
    <button type="submit">create user</button>
</form>

</body>
</html>
