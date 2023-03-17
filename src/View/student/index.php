<?php
require "./../../../vendor/autoload.php";

use Owl\RepoPoo\Config\Conexion;

session_start();
if ($_SESSION["tipo"] !== 3) header("Location:http://localhost/repo_poo/src/Controller/CtrlLogout.php");

include_once("./../components/header.php");
?>

<body>
  <div class="container_main">
    <div class="headerBox">
      <header class="header container">
        <a href="./" class="header__logo">
          <img class="header__imgLogo" src="http://localhost/repoOffi/logo.png" alt="logo" />
        </a>
        <nav class="nav">
          <i id="iconUser" class="ph-user-circle"></i>
          <div id="userBar" class="nav__bar">
            <span class="nav__username"><?php echo $_SESSION["nombres"], " ", $_SESSION["apellidos"] ?></span>
            <ul class="nav__ul">
              <li class="nav__item">
                <a class="nav__link" href="http://localhost/repo_poo/src/Controller/CtrlLogout.php"><i class="ph-student"></i>Proyectos de mi carrera</a>
              </li>
              <li class="nav__item">
                <a class="nav__link" href="http://localhost/repo_poo/src/Controller/CtrlLogout.php"><i class="ph-books"></i>Todos los proyectos</a>
              </li>
              <li class="nav__item">
                <a class="nav__link" href="http://localhost/repo_poo/src/Controller/CtrlLogout.php"><i class="ph-sign-out"></i> Cerrar Sesión</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    </div>
    <section class="section__main">
      <main class="main container">
        <div class="top">
          <h1>Mis proyectos</h1>
          <a href="">Otros proyectos</a>
        </div>
        <hr />
        <div id="projectsBox" class="projectsBox">
          <article id="upload" class="project project__upload">
            <i class="ph-upload-simple"></i>
            <span>Subir proyecto</span>
          </article>
        </div>
      </main>
    </section>
    <div class="formBackground">
      <form id="formUpload" class="form">
        <div id="closeForm" class="form__close">
          <i class="ph-x"></i>
        </div>
        <h1 class="form__title">Subir proyecto</h1>
        <fieldset class="form__group">
          <legend>Título</legend>
          <input type="text" class="form__input" name="tx_title" placeholder="Escriba el título del proyecto" required />
        </fieldset>
        <fieldset class="form__group">
          <legend>Tipo</legend>
          <select name="tx_type" class="form__input" required>
            <option value="" selected disabled>Seleccione el tipo</option>
            <option value="1">Proyecto de innovación</option>
            <option value="2">Proyecto de mejora</option>
            <option value="3">Proyecto de creatividad</option>
          </select>
        </fieldset>
        <fieldset class="form__group">
          <legend>Instructor</legend>
          <select name="tx_ins" class="form__input" required>
            <option value="" selected disabled>Seleccione el instructor</option>
            <?php
            $db = new Conexion();
            $sedeId = $_SESSION["sedeId"];
            $carreraId = $_SESSION["carreraId"];

            $sql = "SELECT * FROM usuarios WHERE tipo=2 AND sedeId=$sedeId AND carreraId=$carreraId";
            $instructores = $db->consultar($sql);
            foreach ($instructores as $instructor) {
              echo '
                  <option value="' . $instructor["userId"] . '">' . $instructor["nombres"] . " " . $instructor["apellidos"] . '</option>
                  ';
            }
            ?>
          </select>
        </fieldset>
        <fieldset class="form__group">
          <legend>Autores</legend>
          <input type="text" class="form__input" name="tx_authors" placeholder="Ejem: 1341793, 1341799" required />
        </fieldset>
        <fieldset class="form__group">
          <legend>Descripción</legend>
          <textarea class="form__input" name="tx_descri" placeholder="Escriba una descrición general del proyecto" required></textarea>
        </fieldset>
        <div class="form__fileBox">
          <label for="file" class="fileBox__labelBtn">Subir archivo</label>
          <input type="file" name="file" id="file" class="inputFile" accept=".pdf,.doc,.docx" required />
        </div>
        <button type="submit" value="Subir" class="form__submit">
          Subir
        </button>
      </form>
    </div>
  </div>
  <script src="./script.js"></script>
</body>

</html>

<script>
  const userId = <?php echo $_SESSION["userId"] ?>;
  getProjects(userId);
</script>
</body>

</html>