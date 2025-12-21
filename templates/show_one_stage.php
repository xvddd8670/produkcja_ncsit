<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/sqlite_helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/table_generator.php';
$db = new SQLiteManager('orders.db');

$_SESSION['workplace'];

switch ($_SESSION['workplace']) {
    case "operator":
        $stage = 'fabrication';
        break;
    case "painter":
        $stage = 'painting';
        break;
    case "assembler":
        $stage = 'assembly';
        break;
    case "packer":
        $stage = 'packaging';
        break;
    default:
        $stage = '';
}

?>
<div style="display: flex; gap: 20px; width: 100%; overflow-x: auto;">
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['stage' => $stage]);
    echo TableGenerator::renderTable($dbdata, '', edit_row: false);
?>
</div>
</div>
