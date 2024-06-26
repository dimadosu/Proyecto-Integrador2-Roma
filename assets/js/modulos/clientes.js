let tblClientes;

document.addEventListener("DOMContentLoaded", function () {
  tblClientes = $("#tableClientes").DataTable({
    ajax: {
      url: base_url + "clientesM/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombres" },
      { data: "apellido_paterno" },
      { data: "apellido_materno" },
      { data: "dni" },
      { data: "correo_electronico" },
      { data: "numero_celular" },
      { data: "accion" },
    ],
  });

});

function alertas(msg, icono) {
  Swal.fire({
    title: "Aviso",
    text: msg,
    icon: icono,
  });
}

function eliminarCliente(idCliente) {
  Swal.fire({
    title: "Aviso",
    text: "Esta seguro de eliminar el usuario?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "clientesM/eliminarCliente/" + idCliente;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tblUsuario.ajax.reload();
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function editCliente(idCliente) {
  const url = base_url + "clientesM/edit/" + idCliente;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      formulario(res);
      title.textContent = "Modificar Usuario";
      btnAccion.textContent = "Actualizar";
      modalUsuario.show();
    }
  };
}
