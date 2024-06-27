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
    ],
  });

});
