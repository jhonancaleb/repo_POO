// togle de barra de usuario opciones
iconUser.addEventListener("click", (e) => {
  userBar.classList.toggle("show");
});

// toggle de formulario
const box = document.querySelector(".formBackground");

function toggleForm() {
  box.classList.toggle("show");
  formUpload.reset();
}
document.addEventListener("mouseup", function (event) {
  if (box.classList.contains("show") && !formUpload.contains(event.target))
    toggleForm();
});
const btnUpload = document.getElementById("upload");
btnUpload.addEventListener("click", toggleForm);
closeForm.addEventListener("click", toggleForm);

//PETICIONES FECTH
async function getProjects(userId) {
  try {
    const response = await fetch("http://localhost/repo_poo/src/Controller/CtrlGetProUser.php",{
      method: "POST",
      body: new URLSearchParams("userId=" + userId),
    });
    if (response.ok) {
      const jsonData = await response.json();
      console.log(jsonData);
      const boxProject = document.getElementById("projectsBox");
      jsonData.forEach((project) => {
        boxProject.innerHTML = `
        <article class="project" style="--cl:${project.clr}">   
          <h1 class="project__title">${project.titulo}</h1>
          <h2 class="project__type">PROYECTO DE ${project.tipo}</h2>
          <p class="project__descri">${project.descripcion}</p>
          <span class="project__state">${project.estado}</span>
        </article>
        `;
      });
    }
  } catch (error) {
    console.log("Ocurrio un error: " + error.message);
  }
}
async function getFile(userId) {
  try {
    const response = await fetch(
      "http://localhost/repo_poo/src/Controller/CtrlGetProUser.php",
      {
        method: "POST",
        body: new URLSearchParams("userId=" + userId),
      }
    );
    if (response.ok) {
      const blobData = await response.blob();
      console.log(blobData);
    }
  } catch (error) {
    console.log("Ocurrio un error: " + error.message);
  }
}

const form = document.getElementById("formUpload");
form.addEventListener("submit", async (e) => {
  e.preventDefault();
  try {
    const response = await fetch(
      "http://localhost/repo_poo/src/Controller/CtrlUpload.php",
      {
        method: "POST",
        body: new FormData(form),
      }
    );
    if (response.ok) {
      const res = await response.text();
      getProjects(userId);
      console.log(res);
      if (res == "ok") {
        toggleForm();
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Proyecto subido",
          showConfirmButton: false,
          timer: 1500,
        });
      } else if (res == "exist") {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "No puedes subir más de un proyecto",
        });
      }
    }
  } catch (error) {
    console.log("Ocurrio un error: " + error.message);
  }
});
