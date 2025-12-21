<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>form</title>
</head>
<body>


<?php

session_start();


if (isset($_SESSION['user_id'])){
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


</body>
