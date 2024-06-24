const tableLista = document.querySelector("#tableListaProductos tbody"); //obtenemos el cuerpo de toda la tabla de la
//lista de deseo
const btnPCEntrega = document.getElementById("btnPCEntrega");

const tblPendientes = document.querySelector("#tblPendientes");

const modalPedido = new bootstrap.Modal(document.getElementById("modalPedido"));

document.addEventListener("DOMContentLoaded", function () {
  //alert("cargando script")
  let login = JSON.parse(localStorage.getItem("login"));
  let idCliente = login.idCliente;
  //console.log(idCliente);
  if (tableLista) {
    getListaProductos();

    //cargando datos de tabla pendientes
    $("#tblPendientes").DataTable({
      ajax: {
        url: base_url + "clientes/listarVenta/" + idCliente,
        dataSrc: "",
      },
      columns: [
        { data: "id" },
        { data: "fecha" },
        { data: "igv" },
        { data: "importe" },
        { data: "total" },
        { data: "accion" },
      ],
      dom,
      buttons,
    });
  }

  /*
  paypal
    .Buttons({
      // Call your server to set up the transaction
      createOrder: function (data, actions) {
        return fetch("/demo/checkout/api/paypal/order/create/", {
          method: "post",
        })
          .then(function (res) {
            return res.json();
          })
          .then(function (orderData) {
            return orderData.id;
          });
      },

      // Call your server to finalize the transaction
      onApprove: function (data, actions) {
        return fetch(
          "/demo/checkout/api/paypal/order/" + data.orderID + "/capture/",
          {
            method: "post",
          }
        )
          .then(function (res) {
            return res.json();
          })
          .then(function (orderData) {
            // Three cases to handle:
            //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
            //   (2) Other non-recoverable errors -> Show a failure message
            //   (3) Successful transaction -> Show confirmation or thank you

            // This example reads a v2/checkout/orders capture response, propagated from the server
            // You could use a different API or structure for your 'orderData'
            var errorDetail =
              Array.isArray(orderData.details) && orderData.details[0];

            if (errorDetail && errorDetail.issue === "INSTRUMENT_DECLINED") {
              return actions.restart(); // Recoverable state, per:
              // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
            }

            if (errorDetail) {
              var msg = "Sorry, your transaction could not be processed.";
              if (errorDetail.description)
                msg += "\n\n" + errorDetail.description;
              if (orderData.debug_id) msg += " (" + orderData.debug_id + ")";
              return alert(msg); // Show a failure message (try to avoid alerts in production environments)
            }

            // Successful capture! For demo purposes:
            console.log(
              "Capture result",
              orderData,
              JSON.stringify(orderData, null, 2)
            );
            var transaction = orderData.purchase_units[0].payments.captures[0];
            alert(
              "Transaction " +
                transaction.status +
                ": " +
                transaction.id +
                "\n\nSee console for all available details"
            );

            // Replace the above to show a success message within this page, e.g.
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '';
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
      },
    })
    .render("#paypal-button-container");*/
});

//verCarrito
function getListaProductos() {
  let html = "";
  const url = base_url + "principal/listaProductos"; // url del controlador
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaCarrito)); //iniciamos la body del request con la lista de deseo del localStrorage
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //validamos la respuesta
      const res = JSON.parse(this.responseText);
      //console.log(res);
      //res-> cotiene productos[array] y el total-> Controlador Principal
      if (res.totalNeto > 0) {
        res.productos.forEach((producto) => {
          html += `
                    <tr>
                        <td>
                            <img src="${producto.imagen}" 
                                alt="" class="img-thumbnail 
                                rounded-circle" width="100"
                            >
                        </td>
                        <td class="fw-normal">${producto.nombre}</td>
                        <td class="text-center fw-normal">
                          ${producto.precio}
                        </td>
                        <td class="text-center fw-normal">${producto.cantidad}</td>
                        <td class="text-center fw-normal">${producto.subTotal}</td>
                        
                    </tr>
                    `;
        });
        tableLista.innerHTML = html;
        document.querySelector("#subProducto").textContent =
          "Sub Total = " + "S/ " + res.total;
        document.querySelector("#txtIGV").textContent = "IGV: 18 %";
        document.querySelector("#totalNeto").textContent =
          "Total Neto = " + "S/ " + res.totalNeto;
        localStorage.setItem("arrayPedidos", JSON.stringify(res));
      } else {
        tableLista.innerHTML = `
          <tr>
            <td colspan="5" class="text-center">Carrito Vacío</td>
          </tr>
        `;
      }
    }
  };
}

//registra pedido a la bd
function registrarPedido() {
  const datos = JSON.parse(localStorage.getItem("arrayPedidos"));
  const url = base_url + "clientes/registrarPedidos"; // url del controlador
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(datos)); //iniciamos la body del request con la lista de deseo del localStrorage
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //validamos la respuesta
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      Swal.fire({
        title: "Aviso",
        text: res.msg,
        icon: res.icono,
      });
      if (res.icono == "success") {
        localStorage.removeItem("listaCarrito");
        localStorage.removeItem("arrayPedidos");
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      } else {
      }
    }
  };
}

//obtener el detalle de un venta
function verPedido(idPedido) {
  const url = base_url + "clientes/verPedido/" + idPedido;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 || this.readyState == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      //res-> cotiene la lista del pedido seleccionado
      let contador = 0;
      res.forEach((pedido) => {
        html += `
                <tr>
                    <td class"text-center">${(contador = contador + 1)}</>
                    <td class="fw-bold">${pedido.descripcion}</td>
                    <td class="text-center fw-bold">${pedido.precio}</td>
                    <td class="text-center fw-bold">${pedido.cantidad}</td>
                    <td class="text-center fw-bold">${pedido.importe}</td>
                </tr>
                `;
      });
      document.querySelector("#tblDetallePedido tbody").innerHTML = html;
      modalPedido.show();
    }
  };
}
