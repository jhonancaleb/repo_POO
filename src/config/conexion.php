<?php

namespace Owl\RepoPoo\Config;

use PDOException;
use PDO;

class Conexion
{
  private $server = "localhost";
  private $user = "root";
  private $db = "repo";
  private $password = "";
  private $conexion;

  public function __construct()
  {
    try {
      $this->conexion = new PDO("mysql:host=$this->server;dbname=$this->db", $this->user, $this->password);
      $this->conexion->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      return "Falla de conexion" . $e;
    }
  }


  public function ejecutar($sql)
  {
    $this->conexion->exec($sql);
    return $this->conexion->lastinsertid();
  }

  public function consultar($sql)
  {
    $sentencia = $this->conexion->prepare($sql);
    $sentencia->execute();
    return $sentencia->fetchAll();
  }

  public function consultarOne($sql)
  {
    $sentencia = $this->conexion->prepare($sql);
    $sentencia->execute();
    return $sentencia->fetch();
  }
}
