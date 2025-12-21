<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/sqlite_helper.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $db = new SQLiteManager($_SERVER['DOCUMENT_ROOT'] . '/orders.db');
} catch (Exception $e) {
     "error: " . $e->getMessage();
}

$client = $_POST['client'] ?? '';
$created = date('Y-m-d\TH:i');
$term = $_POST['term'] ?? '';
$stage = 'new';
$status = 'new';
$comment = $_POST['comment'] ?? '';

$db->insert('production',
    ['client' => $client,
    'created' => $created,
    'term' => $term,
    'stage' => 'new',
    'status' => 'new',
    'comment' => $comment
]);
?>

<br>++++++++++++++++++++++++++++++++++++++++++++++++++++
<br>+++++++++++++++ADD NEW ORDER++++++++++++++++++++++
<br>++++++++++++++++++++++++++++++++++++++++++++++++++++

<form method="post" action="">
    <input type="text" name="client" placeholder="client" required><br>
    term: <input type="datetime-local" name="term" required><br>
    <input type="text" name="comment" placeholder="comment"><br>
    <button type="submit">add new order</button>
</form>
