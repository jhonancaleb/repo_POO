<?php
require "./../../../vendor/autoload.php";

use Owl\RepoPoo\Config\Conexion;

session_start();
if ($_SESSION["tipo"] !== 3) header("Location:http://localhost/repo_poo/src/Controller/CtrlLogout.php");

include_once("./../components/header.php");
?>

<body>
  <div class="container_main font-montserrat overflow-x-hidden">
    <div class="bg-slate-200">
      <header class="header box-border container px-3 mx-auto w-full h-[75px] flex justify-between items-center">
        <a href="./" class="logo w-64 box-border">
          <img class="w-full h-full object-cover" src="http://localhost/repoOffi/logo.png" alt="logo">
        </a>
        <nav class="relative nav flex items-center gap-2">
          <i id="iconUser" class="ph-user-circle text-3xl"></i>
          <div id="userBar" class="userBar">
            <span class="block mb-3 uppercase text-center w-full"><?php echo $_SESSION["nombres"], " ", $_SESSION["apellidos"] ?></span>
            <ul>
              <li class="whitespace-nowrap"><a class="flex h-full items-center gap-3 py-4 sm:py-2 px-5 hover:bg-c_gray" href="http://localhost/repo_poo/src/Controller/CtrlLogout.php"><i class="ph-student"></i>Proyectos de mi carrera</a></li>
              <li class="whitespace-nowrap"><a class="flex h-full items-center gap-3 py-4 sm:py-2 px-5 hover:bg-c_gray" href="http://localhost/repo_poo/src/Controller/CtrlLogout.php"><i class="ph-books"></i>Todos los proyectos</a></li>
              <li class="whitespace-nowrap"><a class="flex h-full items-center gap-3 py-4 sm:py-2 px-5 hover:bg-c_gray" href="http://localhost/repo_poo/src/Controller/CtrlLogout.php"><i class="ph-sign-out"></i> Cerrar Sesión</a></li>
            </ul>
          </div>
        </nav>
      </header>
    </div>
    <section class="w-full mt-3">
      <main class="container px-3 mx-auto">
        <div class="flex justify-between items-center py-3 border-b-2 border-gray-400 border-solid">
          <h1 class="text-xl font-semibold">Mis proyectos</h1>
          <a href="" class="text-sm text-c_gold">Otros proyectos</a>
        </div>
        <div id="projectBox" class="w-full py-5 grid grid-flow-row-dense grid-cols-[repeat(auto-fit,minmax(15em,1fr))] auto-rows-[13rem] gap-6">
          <article id="upload" class="group w-full h-full p-5 rounded-md flex flex-col justify-center items-center border-2  border-slate-300 hover:border-c_gray hover:text-c_gray text-slate-300  cursor-pointer">
            <i class="ph-upload-simple font-bold text-xl"></i>
            <span class="font-bold">Subir proyecto</span>
          </article>
        </div>
      </main>
    </section>
    <div class="formBox fixed px-2 hidden items-center justify-center w-full h-full top-0 left-0 bg-black bg-opacity-20 backdrop-blur-sm">
      <form id="formUpload" class="form relative p-4 sm:p-8 flex flex-col gap-2 bg-white rounded-sm w-full h-auto max-w-lg">
        <div id="closeForm" class="absolute top-3 right-3 grid place-items-center p-2 rounded-sm text-lg active:bg-slate-200"><i class="ph-x"></i></div>
        <h1 class="text-center font-bold text-lg text-c_blue">Subir proyecto</h1>
        <fieldset class="form__group">
          <legend for="">Título</legend>
          <input type="text" class="form__input" name="tx_title" placeholder="Escriba el título del proyecto" required>
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
          <input type="text" class="form__input" name="tx_authors" placeholder="Ejem: 1341793, 1341799" required>
        </fieldset>
        <fieldset class="form__group">
          <legend>Descripción</legend>
          <textarea class="form__input h-[120px] resize-none" name="tx_descri" placeholder="Escriba una descrición general del proyecto" required></textarea>
        </fieldset>
        <div class="fileBox w-full my-2">
          <label for="file" class="bg-c_main py-2 px-4 rounded-sm text-white text-sm active:bg-opacity-80">Subir archivo</label>
          <input type="file" name="file" id="file" class="hidden" accept=".pdf,.doc,.docx" required>
        </div>
        <button type="submit" value="Subir" class="submit">Subir</button>
      </form>
    </div>
  </div>
  <script src="./script.js"></script>
  <script>
    const userId=<?php echo $_SESSION["userId"] ?>;
    getProjects(userId);
  </script>
</body>

</html>