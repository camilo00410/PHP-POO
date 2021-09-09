<?php

require_once "./../db.php";


$nombre_imagen = $_FILES['imagen']['name'];
$temporal= $_FILES['imagen']['tmp_name'];
$carpeta="../img";
$ruta=$carpeta.'/'.$nombre_imagen;
move_uploaded_file($temporal,$carpeta.'/'.$nombre_imagen);

$_POST['imagen'] = $ruta;
$db = new DB;
$insert = $db->insert('persona', $_POST);
$table = $db->select('persona');
echo json_encode($table);