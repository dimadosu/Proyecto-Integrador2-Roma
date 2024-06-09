const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const title = document.querySelector("#titleModal");

const btnAccion = document.querySelector("#btnAccion");

let tblCategorias;

function alertas(msg, icono) {
  Swal.fire({
    title: "Aviso",
    text: msg,
    icon: icono,
  });
}

const modalCategoria = new bootstrap.Modal(
  document.getElementById("modalCategoria")
);

document.addEventListener("DOMContentLoaded", function () {
  tblCategorias = $("#tblCategorias").DataTable({
    ajax: {
      url: base_url + "categorias/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "imagen" },
      { data: "accion" },
    ],
  });

  //levantar modal para nuevo registro de usuarios
  nuevo.addEventListener("click", function () {
    document.querySelector("#id").value = "";
    document.querySelector('#imagen_actual').value ="";
    document.querySelector('#imagen').value = "";
    frm.reset();
    title.textContent = "Nueva Categoria";
    btnAccion.textContent = "Registrar";
    modalCategoria.show();
  });

  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "categorias/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          modalCategoria.hide();
          tblCategorias.ajax.reload();
        }
        alertas(res.msg, res.icono);
      }
    };
  });
});

function eliminarCat(idCat) {
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
      const url = base_url + "categorias/eliminarCategoria/" + idCat;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tblCategorias.ajax.reload();
            document.querySelector('#imagen').value = "";
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function editCat(idCat) {
  const url = base_url + "categorias/edit/" + idCat;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      formulario(res);
      title.textContent = "Modificar Categoria";
      btnAccion.textContent = "Actualizar";
      modalCategoria.show();
    }
  };
}

function formulario(res){
    document.querySelector('#id').value = res.id;
    document.querySelector('#categoria').value = res.nombre;
    document.querySelector('#imagen_actual').value = res.imagen;
}