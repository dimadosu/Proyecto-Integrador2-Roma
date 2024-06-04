const frm = document.querySelector("#formulario");
const email = document.querySelector("#email");
const clave = document.querySelector("#clave");

document.addEventListener("DOMContentLoaded", function () {
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (email.value == "" || clave.value == "") {
      //alertas("campos vacios", "error")
    } else {
      let data = new FormData();
      data.append("email", email.value);
      data.append("clave", clave.value);
      const url = base_url + "admin/validar";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            window.location = base_url + "admin/home";
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
});

function alertas(msg, icono) {
  Swal.fire({
    title: "Aviso",
    text: msg,
    icon: icono,
  });
}
