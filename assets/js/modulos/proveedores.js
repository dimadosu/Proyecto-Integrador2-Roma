const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const title = document.querySelector("#titleModal");

const btnAccion = document.querySelector('#btnAccion');

let tblProveedor;

const modalProveedor = new bootstrap.Modal(
  document.getElementById("modalProveedor")
);

document.addEventListener("DOMContentLoaded", function () {
  tblProveedor = $("#tableProveedores").DataTable({
    ajax: {
      url: base_url + "proveedores/listar",
      dataSrc: "data",  // Asegúrate de que 'data' sea el nombre del campo que contiene los datos en la respuesta JSON
    },
    columns: [
      { data: "id" },
      { data: "correo_contacto" },
      { data: "nombre_comercial" },
      { data: "nombre_contacto" },
      { data: "numero_contacto" },
      { data: "razon_social" },
      { data: "ruc" },
      { data: "accion" },
    ],
  });

  nuevo.addEventListener("click", function () {
    document.querySelector('#id').value = '';
    frm.reset();
    title.textContent = "Nuevo Proveedor";
    btnAccion.textContent = "Registrar";
    modalProveedor.show();
  });

  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "proveedores/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          modalProveedor.hide();
          tblProveedor.ajax.reload();
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

function eliminarProveedor(idProveedor) {
  Swal.fire({
    title: "Aviso",
    text: "¿Está seguro de eliminar el proveedor?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "proveedores/eliminarProveedor/" + idProveedor;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tblProveedor.ajax.reload();
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function editProveedor(idProveedor) {
  const url = base_url + "proveedores/edit/" + idProveedor;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      formulario(res);
      title.textContent = "Modificar Proveedor";
      btnAccion.textContent = 'Actualizar'
      modalProveedor.show();
    }
  };
}

function formulario(res) {
  document.querySelector('#id').value = res.id;
  document.querySelector('#correo_contacto').value = res.correo_contacto;
  document.querySelector('#nombre_comercial').value = res.nombre_comercial;
  document.querySelector('#nombre_contacto').value = res.nombre_contacto;
  document.querySelector('#numero_contacto').value = res.numero_contacto;
  document.querySelector('#razon_social').value = res.razon_social;
  document.querySelector('#ruc').value = res.ruc;
}
