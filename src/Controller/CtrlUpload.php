<?php

require "./../../vendor/autoload.php";

use Owl\RepoPoo\Model\Project;

session_start();
// if ($_SESSION["userId"] != $userId) {
//   echo 'Cambiaste de usuario Pillin';
//   return false;
// };
date_default_timezone_set('America/Lima');
// datos
$titulo = $_POST["tx_title"];
$tipo = $_POST["tx_type"];
$instructorId = $_POST["tx_ins"];
$carreraId = $_SESSION["carreraId"];
$autores = $_POST["tx_authors"];
$descri = $_POST["tx_descri"];
$file = $_FILES["file"];
$fecha = date("Y-m-d");
if (
  empty($titulo) ||
  empty($tipo) ||
  empty($instructorId)  ||
  empty($carreraId) ||
  empty($autores) ||
  empty($descri) ||
  empty($file) ||
  empty($fecha)
) {
  echo "vacio";
}

$ObjProject = new Project;
$res = $ObjProject->upload($titulo, intval($tipo), $descri, $autores, intval($carreraId), intval($instructorId), $fecha);

if ($res) echo "ok";
else echo "exist";
