<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/sqlite_helper.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $db = new SQLiteManager($_SERVER['DOCUMENT_ROOT'] . '/orders.db');
} catch (Exception $e) {
     "error: " . $e->getMessage();
}

$row_id = $_POST['row_id'] ?? '';
$client = $_POST['client'] ?? '';
$stage = $_POST['stage'] ?? '';
$status = $_POST['status'] ?? '';
$comment = $_POST['comment'] ?? '';
#$dbdata = $db->selectWhere('production', ['ID' => $row_id]);

$db->update('production',
    [
        'client' => $client,
        'stage' => $stage,
        'status' => $status,
        'comment' => $comment
    ],
    ['ID' => $row_id])

?>
