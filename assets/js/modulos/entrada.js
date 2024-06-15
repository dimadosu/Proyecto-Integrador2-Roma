let tblEntradas;

document.addEventListener("DOMContentLoaded", function () {
  tblEntradas = $("#tblEntradas").DataTable({
    ajax: {
      url: base_url + "productos/listarEntradas",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombre_producto" },
      { data: "cantidad" },
      { data: "stock" },
      { data: "fecha" }
    ],
  });
});
