const frmDireccion = document.querySelector("#frmDireccion");

document.addEventListener("DOMContentLoaded", function () {
  frmDireccion.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "clientes/actualizarDireccion"; // url del controlador
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data); //enviamos la data del register
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          window.location.reload();
        }
        Swal.fire({
          title: "Aviso",
          text: res.msg,
          icon: res.icono,
        });
      }
    };
  });
});
