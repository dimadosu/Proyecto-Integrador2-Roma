let tblSalidas;

document.addEventListener("DOMContentLoaded", function () {
  tblSalidas = $("#tblSalidas").DataTable({
    ajax: {
      url: base_url + "productos/listarSalidas",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombre_producto" },
      { data: "cantidad" },
      { data: "fecha" }
    ],
  });
});