<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/sqlite_helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/page_factory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/table_generator.php';


session_start();

# welcome user or login
if (isset($_SESSION['user_id'])){
    ?>
    <a href="templates/logout.php">
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

echo '<br>================================================<br>';

$page = PageFactory::create($_SESSION);
$page->render();

?>
