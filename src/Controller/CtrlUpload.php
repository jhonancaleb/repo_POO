<?php

require "./../../vendor/autoload.php";

use Owl\RepoPoo\Model\Project;

session_start();

$ObjProject = new Project;

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

$filename = strtotime("now") . "_" . $_FILES['file']['name'];
$file_tmp = $_FILES['file']['tmp_name'];

// Mover el archivo a una ubicación permanente en el servidor
$dir_destiny = '../uploads/files_projects/';
$fileRute = $dir_destiny . $filename;
move_uploaded_file($file_tmp, $fileRute);

$arrayAuthors = explode(",", $autores);
// validacion de si ya subio un proyecto
$sql_val = "SELECT * FROM proyectos";
$projects = $ObjProject->conexion->consultar($sql_val);
$count = 0;
foreach ($projects as $proj) {
  $arrProAuthors = explode(",", $proj["autores"]);
  $inters = array_intersect($arrayAuthors, $arrProAuthors);
  count($inters) > 0 ? $count = $count + 1 : "";
}
if ($count > 0) echo "exist";
else {
  $res = $ObjProject->upload($titulo, intval($tipo), $descri, $autores, $filename, intval($carreraId), intval($instructorId), $fecha);
  if ($res) echo "ok";
}
