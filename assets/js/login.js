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
const inputBusqueda = document.querySelector("#inputMobileSearch");

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
            localStorage.setItem('login', JSON.stringify(res));
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        }
      };
    }
  });

  //busqieda del producto-FALTA COMPLETAR 
  inputBusqueda.addEventListener("keyup", function (e) {
    const url = base_url + "principal/busqueda/" + e.target.value; // mandamos a este controlador y metodo
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        //const res = JSON.parse(this.responseText);
        
      }
    };
  });

  //elimiinarmos la session del usuario
  if(cerrar){
    cerrar.addEventListener("click", function(){
      localStorage.removeItem('login');
    })
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
