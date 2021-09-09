<?php

require_once './../db.php';
$db = new DB;
$update = $db->update('persona', $_POST, 'id', $_POST['id']);
$select = $db->select('persona');
echo json_encode($select);