const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const title = document.querySelector("#titleModal");

const btnAccion  = document.querySelector('#btnAccion');

let tblUsuario;

const modalUsuario = new bootstrap.Modal(
  document.getElementById("modalUsuario")
);

function listarTabla(){

}
document.addEventListener("DOMContentLoaded", function () {
  tblUsuario = $("#tableUsuarios").DataTable({
    ajax: {
      url: base_url + "usuarios/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombres" },
      { data: "apellido_paterno" },
      { data: "apellido_materno" },
      { data: "correo" },
      { data: "numero_celular" },
      { data: "id_rol" },
      { data: "accion" },
    ],
  });

  //levantar modal para nuevo registro de usuarios
  nuevo.addEventListener("click", function () {
    document.querySelector('#id').value = '';
    frm.reset();
    title.textContent = "Nuevo Usuario";
    btnAccion.textContent = "Registrar";
    document.querySelector('#clave').removeAttribute('readonly', 'readonly')
    modalUsuario.show();
  });

  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "usuarios/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          modalUsuario.hide();
          tblUsuario.ajax.reload();
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

function eliminarUser(idUser) {
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
      const url = base_url + "usuarios/eliminarUsuario/" + idUser;
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

function editUser(idUser) {
  const url = base_url + "usuarios/edit/" + idUser;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      formulario(res);
      title.textContent = "Modificar Usuario";
      btnAccion.textContent = 'Actualizar'
      modalUsuario.show();
    }
  };
}

function formulario(res){
  document.querySelector('#id').value = res.id;
  document.querySelector('#nombre').value = res.nombres;
  document.querySelector('#apePaterno').value = res.apellido_paterno;
  document.querySelector('#apeMaterno').value = res.apellido_materno;
  document.querySelector('#correo').value = res.correo;
  document.querySelector('#celular').value = res.numero_celular;
  document.querySelector('#clave').setAttribute('readonly', 'readonly')
}


