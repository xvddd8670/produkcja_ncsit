<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>form</title>
</head>
<body>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'classes/sqlite_helper.php';

session_start();
if (isset($_SESSION['user_id'])){
    ?>
    <a href="logout.php">
        <button type="button">logout</button>
    </a>
    <?php
    echo('<br>');
    echo("name: ");
    echo($_SESSION['user_name']);
    echo('<br>');
    echo("group: ");
    echo($_SESSION['user_group']);
} else {
    ?>
    <form method="post" action="login_processing.php">
        <input type="text" name="user" placeholder="user" required><br>
        <input type="text" name="password" placeholder="password" required><br>
        <button type="submit">login</button>
    </form>
    <?php
}
?>
<br>
============================
<br>
<form id="orderForm">
    <input type="text" name="client" placeholder="client" required><br>
    term: <input type="datetime-local" name="term" required><br>
    <input type="text" name="comment" placeholder="comment"><br>
    <button type="button" onclick="sendForm()">submit</button>
</form>

<div id="message"></div>


<?php

echo('<br>');
echo('<br>');

$db = new SQLiteManager('orders.db');

#$dbdata = $db->selectAll('production');
$dbdata = $db->selectWhere('production', ['status' => 'new']);

echo '<table border="1">';
echo '<tr><th>ID</th><th>client</th><th>created</th><th>term</th><th>stage</th><th>status</th><th>history</th><th>comment</th></tr>';

foreach ($dbdata as $row) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['ID']) . '</td>';
    echo '<td>' . htmlspecialchars($row['client'] ?? '') . '</td>';
    echo '<td>' . htmlspecialchars($row['created'] ?? '') . '</td>';
    echo '<td>' . htmlspecialchars($row['term'] ?? '') . '</td>';
    echo '<td>' . htmlspecialchars($row['stage'] ?? '') . '</td>';
    echo '<td>' . htmlspecialchars($row['status'] ?? '') . '</td>';
    echo '<td>' . htmlspecialchars($row['history'] ?? '') . '</td>';
    echo '<td>' . htmlspecialchars($row['comment'] ?? '') . '</td>';
    echo '</tr>';
}

echo '</table>';

?>

<script>
function sendForm() {
    const form = document.getElementById('orderForm');
    console.log(form);
    const formData = new FormData(form);

    fetch('add_order.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('message').innerHTML = '✅';
        form.reset();

        location.reload();
    })
    .catch(error => {
        document.getElementById('message').innerHTML = '❌';
        console.error(error);
    });
}
</script>
</body>
