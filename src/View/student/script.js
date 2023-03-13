// togle de barra de usuario opciones
iconUser.addEventListener("click", (e) => {
  userBar.classList.toggle("show");
});

// toggle de formulario
const box = document.querySelector(".formBox");

function toggleForm() {
  box.classList.toggle("flex");
  box.classList.toggle("hidden");
  formUpload.reset();
}
document.addEventListener("mouseup", function (event) {
  if (box.classList.contains("flex") && !formUpload.contains(event.target))
    toggleForm();
});
upload.addEventListener("click", toggleForm);
closeForm.addEventListener("click", toggleForm);

//PETICIONES FECTH
async function getProjects(userId) {
  try {
    const response = await fetch(
      "http://localhost/repo_poo/src/Controller/CtrlGetProUser.php",
      {
        method: "POST",
        body: new URLSearchParams("userId=" + userId),
      }
    );
    if (response.ok) {
      const jsonData = await response.json();
      console.log(jsonData);
      const boxProject = document.getElementById("projectBox");
      const typePro = ["", "INNOVACIÓN", "MEJORA", "CREATIVIDAD"];
      jsonData.forEach((project) => {
        // boxProject.insertAdjacentHTML(
        //   "afterbegin",
        //   `
        // <article class="project">
        //       <strong>${project.titulo}</strong>
        //       <p>PROYECTO DE ${typePro[project.tipo]}</p>
        //       <span style="--cl:black;">SUBIDO</span>
        // </article>
        // `
        // );
        boxProject.innerHTML=  `
        <article class="project">
              <strong>${project.titulo}</strong>
              <p>PROYECTO DE ${typePro[project.tipo]}</p>
              <span style="--cl:black;">SUBIDO</span>
        </article>
        `
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
      if (res== "ok") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Proyecto subido",
          showConfirmButton: false,
          timer: 1500,
        });
      } else if (res== "exist") {
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
