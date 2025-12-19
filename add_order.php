<?php

require_once 'sqlite_helper.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    // Создай базу в папке с правами на запись
    $db = new SQLiteManager('orders.db');
     'base opened<br>';
} catch (Exception $e) {
     "error: " . $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$client  = $_POST['client'] ?? '';
$created  = date('Y-m-d\TH:i');
$term  = $_POST['term'] ?? '';
$stage  = 'not';
$status  = 'new';
$comment  = $_POST['comment'] ?? '';

$db->insert('production',
    ['client' => $client,
    'created' => $created,
    'term' => $term,
    'stage' => $stage,
    'status' => $status,
    'comment' => $comment
]);

?>
