const frmClave = document.querySelector("#frmClave");

document.addEventListener("DOMContentLoaded", function () {
  frmClave.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "clientes/cambiarClave";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          window.location.reload();
        }
        alertas(res.msg, res.icono);
      }
    };
  });
});
