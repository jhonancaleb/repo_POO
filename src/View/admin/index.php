<?php 
  session_start();
  if($_SESSION["tipo"]!==1) header("Location:http://localhost/repo_poo/src/Controller/CtrlLogout.php");

  include_once("./../components/header.php");
?>
<body>
  Admin
  <?php 
    print_r($_SESSION);
  ?>
  <hr>
  <a href="http://localhost/repo_poo/src/Controller/CtrlLogout.php">salir</a>
</body>
</html>