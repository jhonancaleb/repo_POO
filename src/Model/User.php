<?php

namespace Owl\RepoPoo\Model;

use Owl\RepoPoo\Config\Conexion;
use PDOException;

class User extends Conexion{
  public int $dni;
  public string $names;
  public string $lastanmes;
  public string $email;
  public string $password;
  public int $type;
  public int $sedeId;
  public int $carreraId;
  public $conexion;

  public function __construct(){
    $this->conexion=new Conexion();
  }
  public function login($email, $password){
    try{
      $this->conexion=new Conexion();
      $sql="SELECT * FROM usuarios WHERE correo='$email'";
      $user=$this->conexion->consultarOne($sql);
      if($user){
        if($user["password"]==$password){
          return $user;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }catch(PDOException $e){
      return "Ocurrió un error".$e;
    }
  }
}