<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/sqlite_helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/table_generator.php';
$db = new SQLiteManager('orders.db');
echo '<br>++++++++++++++++++++++++++++++++++++++++++++++++++++';
echo '<br>+++++++++++++++SHOW BY STATUS++++++++++++++++++++++';
echo '<br>++++++++++++++++++++++++++++++++++++++++++++++++++++';

?>
<div style="display: flex; gap: 20px; width: 100%; overflow-x: auto;">
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['status' => 'new']);
    echo TableGenerator::renderTable($dbdata, 'new');
?>
</div>
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['status' => 'work']);
    echo TableGenerator::renderTable($dbdata, 'work');
?>
</div>
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['status' => 'finished']);
    echo TableGenerator::renderTable($dbdata, 'finished');
?>
</div>
</div>
