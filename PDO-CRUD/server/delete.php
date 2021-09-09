<?php
require_once "./../db.php";

$db = new DB;
$delete = $db->delete('persona', 'id = '. $_POST['id']);
$table = $db->select('persona');
echo json_encode($table);