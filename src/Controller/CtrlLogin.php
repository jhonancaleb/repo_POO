<?php 
  
require "./../../vendor/autoload.php";

use Owl\RepoPoo\Model\User;

if($_POST){
  $correo=$_POST["tx_correo"];
  $password=$_POST["tx_password"];

  $user=new User();

  if($user->login($correo,$password)){
    session_start();
    $_SESSION=$user->login($correo,$password);
    // print_r($_SESSION);
    switch($_SESSION["tipo"]){
      case 1:
        header("Location:../View/admin/");
        break;
      case 2:
        header("Location:../View/instructor/");
        break;
      case 3:
        header("Location:../View/student/");
        break;
    }
  }else{
    header("Location:../View/login.php?auth=false");
  }
}
