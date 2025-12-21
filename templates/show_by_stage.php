<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/sqlite_helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/table_generator.php';
$db = new SQLiteManager('orders.db');
echo '<br>++++++++++++++++++++++++++++++++++++++++++++++++++++';
echo '<br>+++++++++++++++SHOW BY STAGE+++++++++++++++++++++++';
echo '<br>++++++++++++++++++++++++++++++++++++++++++++++++++++';

?>
<div style="display: flex; gap: 20px; width: 100%; overflow-x: auto;">
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['stage' => 'new']);
    echo TableGenerator::renderTable($dbdata, 'new stage', true);
?>
</div>
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['stage' => 'fabrication']);
    echo TableGenerator::renderTable($dbdata, 'fabrication');
?>
</div>
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['stage' => 'painting']);
    echo TableGenerator::renderTable($dbdata, 'painting');
?>
</div>
</div>

<div style="display: flex; gap: 20px; width: 100%; overflow-x: auto;">
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['stage' => 'assembly']);
    echo TableGenerator::renderTable($dbdata, 'assembly');
?>
</div>
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['stage' => 'packaging']);
    echo TableGenerator::renderTable($dbdata, 'packaging');
?>
</div>
<div style="flex: 1; min-width: 300px; max-width: 33%; overflow-x: auto;">
<?php
    $dbdata = $db->selectWhere('production', ['stage' => 'wait_materials']);
    echo TableGenerator::renderTable($dbdata, 'wait materials');
?>
</div>
</div>
