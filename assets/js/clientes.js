const tableLista = document.querySelector("#tableListaProductos tbody"); //obtenemos el cuerpo de toda la tabla de la
//lista de deseo

document.addEventListener("DOMContentLoaded", function () {
  //alert("cargando script")
  if (tableLista) {
    getListaProductos();
  }

  window.paypal
    .Buttons({
      style: {
        shape: "rect",
        layout: "vertical",
        color: "gold",
        label: "paypal",
      },
      async createOrder() {
        try {
          const response = await fetch("/api/orders", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            // use the "body" param to optionally pass additional order information
            // like product ids and quantities
            body: JSON.stringify({
              cart: [
                {
                  id: "YOUR_PRODUCT_ID",
                  quantity: "YOUR_PRODUCT_QUANTITY",
                },
              ],
            }),
          });

          const orderData = await response.json();

          if (orderData.id) {
            return orderData.id;
          }
          const errorDetail = orderData?.details?.[0];
          const errorMessage = errorDetail
            ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
            : JSON.stringify(orderData);

          throw new Error(errorMessage);
        } catch (error) {
          console.error(error);
          // resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
        }
      },
      async onApprove(data, actions) {
        try {
          const response = await fetch(`/api/orders/${data.orderID}/capture`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
          });

          const orderData = await response.json();
          // Three cases to handle:
          //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
          //   (2) Other non-recoverable errors -> Show a failure message
          //   (3) Successful transaction -> Show confirmation or thank you message

          const errorDetail = orderData?.details?.[0];

          if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
            // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
            // recoverable state, per
            // https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
            return actions.restart();
          } else if (errorDetail) {
            // (2) Other non-recoverable errors -> Show a failure message
            throw new Error(
              `${errorDetail.description} (${orderData.debug_id})`
            );
          } else if (!orderData.purchase_units) {
            throw new Error(JSON.stringify(orderData));
          } else {
            // (3) Successful transaction -> Show confirmation or thank you message
            // Or go to another URL:  actions.redirect('thank_you.html');
            const transaction =
              orderData?.purchase_units?.[0]?.payments?.captures?.[0] ||
              orderData?.purchase_units?.[0]?.payments?.authorizations?.[0];
            resultMessage(
              `Transaction ${transaction.status}: ${transaction.id}<br>
          <br>See console for all available details`
            );
            console.log(
              "Capture result",
              orderData,
              JSON.stringify(orderData, null, 2)
            );
          }
        } catch (error) {
          console.error(error);
          resultMessage(
            `Sorry, your transaction could not be processed...<br><br>${error}`
          );
        }
      },
    })
    .render("#paypal-button-container");
});

//verCarrito
function getListaProductos() {
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
                      
                  </tr>
                  `;
      });
      tableLista.innerHTML = html;
      document.querySelector("#totalProducto").textContent =
        "Total a pagar = " + res.moneda + " " + res.total;
    }
  };
}
