<?php

require_once "./db.php";

$db = new DB;
$columns = $db->select('persona');
