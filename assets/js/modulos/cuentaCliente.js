//const btnModificar = document.getElementById("btnModificar");

const frmCuenta = document.querySelector("#frmCuenta");

/*
const idCliente = document.getElementById("id").value;
const dni = document.getElementById("dni").value;
const nombre = document.getElementById("nombre").value;
const apellidoPaterno = document.getElementById("apellidoPaterno").value;
const apellidoMaterno = document.getElementById("apellidoMaterno").value;
const correo = document.getElementById("correo").value;
const celular = document.getElementById("celular").value;
*/

document.addEventListener("DOMContentLoaded", function () {
  frmCuenta.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "clientes/actualizar"; // url del controlador
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data); //enviamos la data del register
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //console.log(this.responseText);
        const respuesta = JSON.parse(this.responseText);
        if (respuesta.icono == "success") {
          window.location.reload();
        }
        Swal.fire({
          title: "Aviso",
          text: respuesta.msg,
          icon: respuesta.icono,
        });
      }
    };
  });
});
