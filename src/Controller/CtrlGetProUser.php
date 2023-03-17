<?php

require "./../../vendor/autoload.php";

use Owl\RepoPoo\Model\Project;

$userId = $_POST["userId"];

session_start();
if ($_SESSION["userId"] != $userId) {
  echo 'Cambiaste de usuario Pillin';
  return false;
};

$ObjProject = new Project;

$project = $ObjProject->getProjUser($userId);

$typePro = ["", "INNOVACIÓN", "MEJORA", "CREATIVIDAD"];
$stateColor= ["red", "black", "orange", "purple","blue","cyan","pink","gray","green"];
$state= ["CANCELADO", "ENVIADO", "OBSERVADO", "CORREGIDO","REVISADO","SUSTENTACIÓN","DESAPROBADO","APROBADO","SUBIDO"];


$project[0]["tipo"]=$typePro[$project[0]["tipo"]];
$project[0]["clr"]=$stateColor[$project[0]["estado"]];
$project[0]["estado"]=$state[$project[0]["estado"]];

// print_r($project);
echo json_encode($project);
