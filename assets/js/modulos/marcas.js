const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const title = document.querySelector("#titleModal");

const btnAccion = document.querySelector('#btnAccion');

let tblMarca;

const modalMarca = new bootstrap.Modal(
  document.getElementById("modalMarca")
);

document.addEventListener("DOMContentLoaded", function () {
  tblMarca = $("#tableMarcas").DataTable({
    ajax: {
      url: base_url + "marcas/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombre_marca" },
      { data: "nombre_comercial" },
      { data: "accion" },
    ],
  });

  //levantar modal para nuevo registro de marcas
  nuevo.addEventListener("click", function () {
    document.querySelector('#id').value = '';
    frm.reset();
    title.textContent = "Nueva Marca";
    btnAccion.textContent = "Registrar";
    modalMarca.show();
  });

  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "marcas/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          modalMarca.hide();
          tblMarca.ajax.reload();
        }
        alertas(res.msg, res.icono);
      }
    };
  });

});

function alertas(msg, icono) {
  Swal.fire({
    title: "Aviso",
    text: msg,
    icon: icono,
  });
}

function eliminarMarca(idMarca) {
  Swal.fire({
    title: "Aviso",
    text: "¿Está seguro de eliminar la marca?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "marcas/eliminarMarca/" + idMarca;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tblMarca.ajax.reload();
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function editMarca(idMarca) {
  const url = base_url + "marcas/edit/" + idMarca;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      formulario(res);
      title.textContent = "Modificar Marca";
      btnAccion.textContent = 'Actualizar'
      modalMarca.show();
    }
  };
}

function formulario(res) {
  document.querySelector('#id').value = res.id;
  document.querySelector('#nombre_marca').value = res.nombre_marca;
  document.querySelector('#id_proveedor').value = res.id_proveedor;
}
