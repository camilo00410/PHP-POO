<?php

require_once './../db.php';

$db = new DB;
$table = $db->select('persona', '*',"id = " . $_POST['id']);
echo json_encode($table);