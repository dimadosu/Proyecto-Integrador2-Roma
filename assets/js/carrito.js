const btnAddDeseo = document.querySelectorAll(".btnAddDeseo"); //obtenemos el contenido de la etiqueta
//console.log(btnAddDeseo);
const btnDeseo = document.querySelector("#btnCantidadDeseo"); //etiqueta que indica la cantidad en la lista de deseo
const btnAddCarrito = document.querySelectorAll(".btnAddCarrito");
const btnCarrito = document.querySelector("#btnCantidadCarrito");

let listaDeseo = [];
let listaCarrito = [];

const verCarrito = document.querySelector("#verCarrito");

const tableListaCarrito = document.querySelector("#tableListaCarrito tbody");

//ver carrito
const myModal = new bootstrap.Modal(document.getElementById("myModal"));

document.addEventListener("DOMContentLoaded", function () {
  if (localStorage.getItem("listaDeseo") != null) {
    listaDeseo = JSON.parse(localStorage.getItem("listaDeseo"));
  }
  if (localStorage.getItem("listaCarrito") != null) {
    listaCarrito = JSON.parse(localStorage.getItem("listaCarrito"));
  }
  for (let i = 0; i < btnAddDeseo.length; i++) {
    btnAddDeseo[i].addEventListener("click", function () {
      let idProducto = btnAddDeseo[i].getAttribute("prod");
      //alert(idProducto);
      agregarDeseo(idProducto);
    });
  }

  for (let i = 0; i < btnAddCarrito.length; i++) {
    btnAddCarrito[i].addEventListener("click", function () {
      let idProducto = btnAddCarrito[i].getAttribute("prod");
      //alert(idProducto);
      //console.log(idProducto);
      agregarCarrito(idProducto, 1);
    });
  }
  cantidadDeseo();
  cantidadCarrito();

  verCarrito.addEventListener("click", function () {
    getListaCarrito();
    myModal.show();
  });
});

function agregarDeseo(idProducto) {
  if (localStorage.getItem("listaDeseo") == null) {
    listaDeseo = [];
  } else {
    let listaExiste = JSON.parse(localStorage.getItem("listaDeseo"));
    for (let i = 0; i < listaExiste.length; i++) {
      if (listaExiste[i]["idProducto"] == idProducto) {
        Swal.fire({
          title: "Aviso",
          text: "El producto ya esta en la lista de deseo",
          icon: "warning",
        });
        return;
      }
    }
    listaDeseo.concat(localStorage.getItem("listaDeseo"));
  }

  listaDeseo.push({
    idProducto: idProducto,
    cantidad: 1,
  });
  localStorage.setItem("listaDeseo", JSON.stringify(listaDeseo)); // se agrega el producto a localStorage, objeto, formato
  Swal.fire({
    title: "Aviso",
    text: "Producto agregado a la lista de deseo",
    icon: "success",
  });
  cantidadDeseo();
}

function cantidadDeseo() {
  let listas = JSON.parse(localStorage.getItem("listaDeseo")); //recuperamos lo que se agrega al localStorage
  //console.log(listas);
  if (listas != null) {
    btnDeseo.textContent = listas.length; // cambiamos el estado de la etiqueta con el tamaño de la lista
  } else {
    btnDeseo.textContent = 0;
  }
}

//agregar productos al carrito
function agregarCarrito(idProducto, cantidad, accion = false) {
  if (localStorage.getItem("listaCarrito") == null) {
    listaCarrito = [];
  } else {
    let listaExiste = JSON.parse(localStorage.getItem("listaCarrito"));
    for (let i = 0; i < listaExiste.length; i++) {
      if (accion) {
        eliminarListaDeseo(idProducto);
      }
      if (listaExiste[i]["idProducto"] == idProducto) {
        Swal.fire({
          title: "Aviso",
          text: "El producto ya esta en la lista de carrito",
          icon: "warning",
        });
        return;
      }
    }
    listaCarrito.concat(localStorage.getItem("listaCarrito"));
  }

  listaCarrito.push({
    idProducto: idProducto,
    cantidad: cantidad,
  });
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito)); // se agrega el producto a localStorage, objeto, formato
  Swal.fire({
    title: "Aviso",
    text: "Producto agregado al carrito",
    icon: "success",
  });
  cantidadCarrito();
}

function cantidadCarrito() {
  let listas = JSON.parse(localStorage.getItem("listaCarrito")); //recuperamos lo que se agrega al localStorage
  //console.log(listas);
  if (listas != null) {
    btnCarrito.textContent = listas.length; // cambiamos el estado de la etiqueta con el tamaño de la lista
  } else {
    btnCarrito.textContent = 0;
  }
}

//verCarrito
function getListaCarrito() {
  const url = base_url + "principal/listaProductos"; // url del controlador
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaCarrito)); //iniciamos la body del request con la lista de deseo del localStrorage
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //validamos la respuesta
      const res = JSON.parse(this.responseText);
      //console.log(res);
      let html = "";
      //res-> cotiene productos[array] y el total-> Controlador Principal
      res.productos.forEach((producto) => {
        html += `
                <tr>
                    <td>
                        <img src="${producto.imagen}" 
                            alt="" class="img-thumbnail 
                            rounded-circle" width="100"
                        >
                    </td>
                    <td class="fw-bold">${producto.nombre}</td>
                    <td class="text-center fw-bold">
                      ${producto.precio}
                    </td>
                    <td class="text-center fw-bold">${producto.cantidad}</td>
                    <td class="text-center fw-bold">${producto.subTotal}</td>
                    <td>
                        <button class="btn btn-info btn-danger btnDeleteCart" type="button" prod="${producto.id}">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </td>
                </tr>
                `;
      });
      tableListaCarrito.innerHTML = html;
      document.querySelector("#totalGeneral").textContent = res.total;
      btnEliminarCarrito();
    }
  };
}

function btnEliminarCarrito() {
  console.log(listaCarrito);
  let listaEliminar = document.querySelectorAll(".btnDeleteCart"); //obtenemos todos los button con la clase
  //console.log(listaEliminar);
  for (let i = 0; i < listaEliminar.length; i++) {
    //cada vez que cliquemos el boton de eliminar, captura el id del producto.
    listaEliminar[i].addEventListener("click", function () {
      let idProducto = listaEliminar[i].getAttribute("prod");
      //alert(idProducto);
      eliminarListaCarrito(idProducto);
    });
  }
  console.log(listaCarrito);
}

function eliminarListaCarrito(idProducto) {
  //console.log(listaDeseo);
  for (let i = 0; i < listaCarrito.length; i++) {
    if (listaCarrito[i]["idProducto"] == idProducto) {
      listaCarrito.splice(i, 1);
    }
  }
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito)); //actualizamo del localStorage
  getListaCarrito(); //mostramos la nueva lista de deseo
  cantidadCarrito(); //cambiamos el estado del icon que se ejecuta en esta funcion
  Swal.fire({
    title: "Aviso",
    text: "Producto eliminado del carrito",
    icon: "success",
  });
  //console.log(listaDeseo);
}
