const tableLista = document.querySelector("#tableListaDeseo tbody"); //obtenemos el cuerpo de toda la tabla de la
//lista de deseo

document.addEventListener("DOMContentLoaded", function () {
  //alert("cargando script")
  getListaDeseo();
});

function getListaDeseo() {
  const url = base_url + "principal/listaProductos"; // url del controlador
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaDeseo)); //iniciamos la body del request con la lista de deseo del localStrorage
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //validamos la respuesta
      const res = JSON.parse(this.responseText);
      //console.log(res);
      let html = "";
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
                    <td>
                        <button class="btn btn-danger btnEliminarDeseo" type="button" prod="${producto.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button class="btn btn-info btn-primary btnAddCart" type="button" prod="${producto.id}">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </td>
                </tr>
                `;
      });
      tableLista.innerHTML = html;
      btnEliminarDeseo();
      btnAgregarProducto();
    }
  };
}

function btnEliminarDeseo() {
  let listaEliminar = document.querySelectorAll(".btnEliminarDeseo"); //obtenemos todos los button con la clase
  //console.log(listaEliminar);
  for (let i = 0; i < listaEliminar.length; i++) {
    //cada vez que cliquemos el boton de eliminar, captura el id del producto.
    listaEliminar[i].addEventListener("click", function () {
      let idProducto = listaEliminar[i].getAttribute("prod");
      //alert(idProducto);
      eliminarListaDeseo(idProducto);
    });
  }
}

function eliminarListaDeseo(idProducto) {
  //console.log(listaDeseo);
  for (let i = 0; i < listaDeseo.length; i++) {
    if (listaDeseo[i]["idProducto"] == idProducto) {
      listaDeseo.splice(i, 1);
    }
  }
  localStorage.setItem("listaDeseo", JSON.stringify(listaDeseo)); //actualizamo del localStorage
  getListaDeseo(); //mostramos la nueva lista de deseo
  cantidadDeseo(); //cambiamos el estado del icon que se ejecuta en esta funcion
  Swal.fire({
    title: "Aviso",
    text: "Producto eliminado de la lista de deseo",
    icon: "success",
  });
  //console.log(listaDeseo);
}

//agregar producto desde la lista de deseo
function btnAgregarProducto() {
  let listaAgregar = document.querySelectorAll('.btnAddCart');
  for (let i = 0; i < listaAgregar.length; i++) {
    listaAgregar[i].addEventListener('click', function(){
      let idProducto = listaAgregar[i].getAttribute('prod');
      agregarCarrito(idProducto, 1, true);
    })
    
  }
}
