<?php

namespace Owl\RepoPoo\Model;

use Owl\RepoPoo\Config\Conexion;

class Project extends Conexion
{
  public string $title;
  public string $description;
  public string $type;
  public string $authors;
  public string $carreraId;
  public string $instructorId;
  public string $file;
  public $conexion;

  public function __construct()
  {
    $this->conexion = new Conexion();
  }
  public function upload($titulo, $tipo, $descripcion, $autores, $carreraId, $instructorId, $fecha)
  {
    $arrayAuthors = explode(",", $autores);
    // validacion de si ya subio un proyecto
    $sql_val = "SELECT * FROM proyectos";
    $projects = $this->conexion->consultar($sql_val);
    foreach ($projects as $proj) {
      $arrProAuthors = explode(",", $proj["autores"]);
      $inters = array_intersect($arrayAuthors, $arrProAuthors);
      $inters ? $res = false : $res = true;
    }
    if (!$res) return $res;
    else {
      $sql = "INSERT INTO proyectos (titulo,tipo,descripcion,autores,carreraId,instructorId,fecha_pres) VALUES('$titulo',$tipo,'$descripcion','$autores',$carreraId,$instructorId,'$fecha')";
      $this->conexion->ejecutar($sql);

      // $sql_d = "INSERT INTO detalleProyecto(proyectoId,estado) VALUES($proyectoId,1)";
      // $this->conexion->ejecutar($sql_d);

      return true;
    }
  }
  public function setState($id, $state)
  {
    $sql = "UPDATE detalleProyecto SET estado=$state WHERE proyectoId=$id";
    $this->conexion->ejecutar($sql);
  }
  public function getInfo($id)
  {
    $sql = "SELECT * FROM proyectos WHERE proyectoId=$id";
    $project = $this->conexion->consultarOne($sql);
    return $project;
  }
  public function getProjUser(int $userId)
  {
    $sql = "SELECT * FROM proyectos";
    $projects = $this->conexion->consultar($sql);
    $projs = [];
    foreach ($projects as $project) {
      $stringAuthors = $project["autores"];
      $arrayAuthors = explode(",", $stringAuthors);
      if (in_array($userId, $arrayAuthors)) {
        unset($project["archivo"]);
        unset($project[5]);
        array_push($projs, $project);
      };
    }
    return $projs;
  }
  public function getFile(int $proyectId)
  {
    $sql = "SELECT * FROM proyectos WHERE proyectoId = $proyectId";
    $project = $this->conexion->consultarOne($sql);
    return $project["archivo"];
  }
}
