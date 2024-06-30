const btnRegister = document.querySelector("#btnRegister");
const btnLogin = document.querySelector("#btnLogin");
const frmLogin = document.querySelector("#frmLogin");
const frmRegister = document.querySelector("#frmRegister");

const registrarse = document.querySelector("#registrarse"); //boton de ir a registro
const login = document.querySelector("#login"); //boton de logueo
const cerrar = document.querySelector("#cerrar"); //boton de cerrar session;

//para el registro
const dniRegistro = document.querySelector("#dniRegistro");
const nombreRegistro = document.querySelector("#nombreRegistro");
const apePaternoRegistro = document.querySelector("#apePaternoRegistro");
const apeMaternoRegistro = document.querySelector("#apeMaternoRegistro");
const celularRegistro = document.querySelector("#celularRegistro");
const correoRegistro = document.querySelector("#correoRegistro");
const claveRegistro = document.querySelector("#claveRegistro");

//para el login
const correoLogin = document.querySelector("#correoLogin");
const claveLogin = document.querySelector("#claveLogin");

//const btnModalLogin = document.querySelector('#btnModalLogin'); //id del boton de login

const modalLogin = new bootstrap.Modal(document.getElementById("modalLogin"));

//const para la busqueda de producto
const inputBusqueda = document.querySelector("#inputModalSearch");

document.addEventListener("DOMContentLoaded", function () {
  btnRegister.addEventListener("click", function () {
    frmLogin.classList.add("d-none");
    frmRegister.classList.remove("d-none");
  });
  btnLogin.addEventListener("click", function () {
    frmLogin.classList.remove("d-none");
    frmRegister.classList.add("d-none");
  });

  //registro del cliente
  registrarse.addEventListener("click", function () {
    if (
      dniRegistro.value == "" ||
      nombreRegistro.value == "" ||
      apePaternoRegistro.value == "" ||
      apeMaternoRegistro.value == "" ||
      celularRegistro.value == "" ||
      correoRegistro.value == "" ||
      claveRegistro.value == ""
    ) {
      Swal.fire({
        title: "Aviso",
        text: "Complete los campos",
        icon: "warnig",
      });
    } else {
      let formData = new FormData();
      formData.append("dni", dniRegistro.value);
      formData.append("nombre", nombreRegistro.value);
      formData.append("apellidoPaterno", apePaternoRegistro.value);
      formData.append("apellidoMaterno", apeMaternoRegistro.value);
      formData.append("celular", celularRegistro.value);
      formData.append("correo", correoRegistro.value);
      formData.append("clave", claveRegistro.value);

      const url = base_url + "clientes/registroDirecto"; // url del controlador
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData); //enviamos la data del register
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          Swal.fire({
            title: "Aviso",
            text: res.msg,
            icon: res.icono,
          });
          if (res.icono == "success") {
            setTimeout(() => {
              enviarCorreo(correoRegistro.value, res.token);
            }, 2000);
          }
        }
      };
    }
  });

  //login de cliente
  login.addEventListener("click", function () {
    if (correoLogin.value == "" || claveLogin.value == "") {
      Swal.fire({
        title: "Aviso",
        text: "Complete los campos",
        icon: "warnig",
      });
    } else {
      let formData = new FormData();
      formData.append("correoLogin", correoLogin.value);
      formData.append("claveLogin", claveLogin.value);

      const url = base_url + "clientes/loginDirecto"; // url del controlador
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData); //enviamos la data del register
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          Swal.fire({
            title: "Aviso",
            text: res.msg,
            icon: res.icono,
          });
          if (res.icono == "success") {
            localStorage.setItem("login", JSON.stringify(res));
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        }
      };
    }
  });

  //busqieda del producto-FALTA COMPLETAR
  inputBusqueda.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {
      let valor = inputBusqueda.value;
      if (valor === "") {
        return;
      }
      const url = base_url + "principal/busqueda/" + valor; // mandamos a este controlador y metodo
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      let html;
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          //console.log(res);
          html = "";
          res.forEach((producto) => {
            html += ` <div class="col-12 col-md-3 mb-4">
                    <div class="card h-100">
                        <a href="${
                          base_url + "principal/detail/" + producto.id
                        }">
                            <img src="${
                              producto.imagen
                            }" class="card-img-top" alt="${
              producto.nombre_producto
            }">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class=" text-right text-dark">${
                                  producto.precio
                                }</li>
                            </ul>
                            <p class="h2 text-decoration-none text-dark">${
                              producto.nombre_producto
                            }</p>
                        </div>
                    </div>
                </div>`;
          });
          document.querySelector("#resultadoBusquda").innerHTML = html;
        }
      };
      html = '';
    }
  });

  //elimiinarmos la session del usuario
  if (cerrar) {
    cerrar.addEventListener("click", function () {
      localStorage.removeItem("login");
    });
  }

  /*modal que muestra el login y register 
  btnModalLogin.addEventListener('click', function(){
    modalLogin.show();
  });*/
});

function enviarCorreo(correo, token) {
  let formData = new FormData();
  formData.append("token", token);
  formData.append("correo", correo);
  const url = base_url + "clientes/enviarCorreo"; // url del controlador
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(formData); //enviamos la data del register
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      Swal.fire({
        title: "Aviso",
        text: res.msg,
        icon: res.icono,
      });
      if (res.icono == "success") {
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      }
    }
  };
}

function abrirModalLogin() {
  myModal.hide();
  modalLogin.show();
}
