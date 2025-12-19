<?php
require_once 'sqlite_helper.php';

#$db = new SQLite3("test.db");
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

$dbdata = $db->selectWhere('users', ['user' => $user]);

#print_r($dbdata[0]['user']);
if (password_verify($password, $dbdata[0]['password'])){
    session_start();
    $_SESSION['user_id'] = $dbdata[0]['ID'];
    $_SESSION['user_name'] = $dbdata[0]['user'];
    $_SESSION['user_group'] = $dbdata[0]['user_group'];
    echo('login ok');
}

?>
