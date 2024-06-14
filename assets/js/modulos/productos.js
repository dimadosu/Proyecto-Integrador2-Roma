const frm = document.querySelector("#frmRegistro");

const btnAccion = document.querySelector("#btnAccion");

let tblProductos;

var firstTabEl = document.querySelector("#myTab li:last-child button");
var firstTab = new bootstrap.Tab(firstTabEl);

function alertas(msg, icono) {
  Swal.fire({
    title: "Aviso",
    text: msg,
    icon: icono,
  });
}

document.addEventListener("DOMContentLoaded", function () {
  tblProductos = $("#tblProductos").DataTable({
    dom: "Bfrtilp",
    ajax: {
      url: base_url + "productos/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombre_producto" },
      { data: "precio" },
      { data: "cantidad" },
      { data: "categoria" },
      { data: "nombre_marca" },
      { data: "medida" },
      { data: "fecha_vencimiento" },
      { data: "imagen" },
      { data: "accion" },
    ],
    buttons: [
      {
        extend: "excelHtml5",
        text: '<i class="fa-solid fa-file-csv"></i>',
        titleAttr: "Exportar a Excel",
        className: "btn btn-success",
      },
      {
        extend: "pdfHtml5",
        text: '<i class="fa-solid fa-file-pdf"></i>',
        titleAttr: "Exportar a PDF",
        className: "btn btn-danger",
      },
    ],
  });

  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "productos/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          frm.reset();
          tblProductos.ajax.reload();
        }
        alertas(res.msg, res.icono);
      }
    };
  });
});

function eliminarProd(idProd) {
  Swal.fire({
    title: "Aviso",
    text: "Esta seguro de eliminar el resgistro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "productos/eliminarProducto/" + idProd;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tblProductos.ajax.reload();
            document.querySelector("#imagen").value = "";
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function editProd(idProd) {
  const url = base_url + "productos/edit/" + idProd;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      formulario(res);
      btnAccion.textContent = "Actualizar";
      firstTab.show();
    }
  };
}

function formulario(res) {
  document.querySelector("#id").value = res.id;
  document.querySelector("#nombre").value = res.nombre_producto;
  document.querySelector("#precio").value = res.precio;
  document.querySelector("#cantidad").value = res.cantidad;
  document.querySelector("#categoria").value = res.id_categoria;
  document.querySelector("#marca").value = res.id_marca;
  document.querySelector("#medida").value = res.id_unidad_medida;
  document.querySelector("#idUser").value = res.id_usuario;
  document.querySelector("#imagen_actual").value = res.imagen;
}
