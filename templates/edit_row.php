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
$dbdata = $db->selectWhere('production', ['ID' => $row_id]);

?>

<form method="post" action="send_edited_row.php">

    <input type="text" name="client" value=
        "<?= htmlspecialchars($dbdata[0]['client']) ?>" required><br>
    <input type="text" name="stage" value=
        "<?= htmlspecialchars($dbdata[0]['stage']) ?>" required><br>
    <input type="text" name="status" value=
        "<?= htmlspecialchars($dbdata[0]['status']) ?>" required><br>
    <input type="text" name="comment" value=
        "<?= htmlspecialchars($dbdata[0]['comment']) ?>" required><br>
    <input type="hidden" name="row_id" value=
        "<?= htmlspecialchars($row_id) ?>" required><br>

    <button type="submit">OK</button>
</form>
