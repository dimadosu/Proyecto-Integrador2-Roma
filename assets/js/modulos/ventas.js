let tblventas, tblventasProceso, tblventasEnviada;

document.addEventListener("DOMContentLoaded", function () {
  tblventas = $("#tableVentas").DataTable({
    ajax: {
      url: base_url + "ventas/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "fecha" },
      { data: "igv" },
      { data: "importe" },
      { data: "total" },
      { data: "cliente" },
      { data: "dni" },
      { data: "accion" },
    ],
  });

  tblventasProceso = $("#tableVentasProceso").DataTable({
    ajax: {
      url: base_url + "ventas/listarVentasProceso",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "fecha" },
      { data: "igv" },
      { data: "importe" },
      { data: "total" },
      { data: "cliente" },
      { data: "dni" },
      { data: "accion" },
    ],
  });

  tblventasEnviada = $("#tableVentasEnviada").DataTable({
    ajax: {
      url: base_url + "ventas/listarVentasEnviadas",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "fecha" },
      { data: "igv" },
      { data: "importe" },
      { data: "total" },
      { data: "cliente" },
      { data: "dni" },
      { data: "accion" },
    ],
  });
});

function cambiarProceso(idventa, proceso) {
  Swal.fire({
    title: "Aviso",
    text:
      proceso == 2
        ? "Quieres cambiar mover a: En proceso?"
        : "Quieres cambiar mover a: En envio?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url =
        base_url + "ventas/actualizarProceso/" + idventa + "/" + proceso;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tblventas.ajax.reload();
            tblventasProceso.ajax.reload();
            tblventasEnviada.ajax.reload();
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function alertas(msg, icono) {
  Swal.fire({
    title: "Aviso",
    text: msg,
    icon: icono,
  });
}
