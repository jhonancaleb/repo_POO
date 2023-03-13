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

// $fileBlob=$project["archivo"];
// $project["archivo"]=base64_encode($fileBlob);
// print_r($project);
echo json_encode($project);
// echo $project;
