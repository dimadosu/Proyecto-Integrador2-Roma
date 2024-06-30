<?php include 'Views/template/header-principal.php'; ?>

<!-- Start Content productos de la lista de deseo-->
<div class="container py-5">

    <!--VERIFICAMOS LA EXISTENCIA DEL CLIENTE-->
    <?php if ($data['verificar']['verificar'] == 1) { ?>
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="carrito-tab" data-bs-toggle="tab" data-bs-target="#carrito" type="button" role="tab" aria-controls="carrito" aria-selected="true">Carrito</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pendientes-tab" data-bs-toggle="tab" data-bs-target="#pendientes" type="button" role="tab" aria-controls="pendientes" aria-selected="false">Pedidos</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!--Panel de carrito-->
            <div class="tab-pane fade show active" id="carrito" role="tabpanel" aria-labelledby="carrito-tab">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-border table-striped table-hover align-middle" id="tableListaProductos">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Precio(S/.)</th>
                                                <th>Cantidad</th>
                                                <th>Importe(S/.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <p id="subProducto" class="fw-normal"></p>
                                <p id="txtIGV" class="fw-normal"></p>
                                <p id="totalNeto" class="fw-normal"></p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-lg">
                            <div class="card-body text-center">
                                <img class="img-thumbnail rounded-circle" src="<?php echo BASE_URL . 'assets/img/logo.png' ?>" alt="img" width="150">
                                <hr>
                                <p><?php echo $_SESSION['nombreCliente']; ?></p>
                                <p><i class="fas fa-envelope"></i><?php echo $_SESSION['correoCliente'] ?></p>
                                <?php if (!empty($_SESSION['direccion'])) { ?>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Paypal
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Contra Entrega
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <button class="btn btn-primary btn-sm" id="btnPCEntrega" onclick="registrarPedido()">Procesar Pago</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <p class="fw-normal">Ingrese una direccion para procesar el pago</p>
                                    <button class="btn btn-primary mb-3 btn-sm" type="button" onclick="levantarModalDireccion()">Agregar</button>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Panel de pedidos pendientes-->
            <div class="tab-pane fade" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
                <div class="col-10">
                    <div class="table-responsive">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover" id="tblPendientes" style="width: 100%;">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Igv</th>
                                            <th>Sub Total</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--Panel de pedidos completados-->
        </div>
    <?php } else { ?>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />
            </svg>
            <div class="h3">
                Verificada tu correo elctronico
            </div>
        </div>
    <?php } ?>
</div>

<!-- Modal del detalle de un pedido-->
<div id="modalPedido" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pedidos</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Lista del Pedido</h5>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-borderer table-striped table-hover align-middle" id="tblDetallePedido" style="width: 100%;">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio(s/.)</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar la dirección del cliente-->
<div id="modalDireccion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="">Ingresar dirección de envío</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="frmRegistroDireccion">
                <div class="row modal-body">
                    <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['idCliente'] ?>">
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="distrito" class="fw-bold">Distrito</label>
                            <select class="form-control" id="distrito" name="distrito">
                                <option>Ica</option>
                                <option>La Tinquiña</option>
                                <option>Los Aquijes</option>
                                <option>Ocucaje</option>
                                <option>Pachacútec</option>
                                <option>Parcona</option>
                                <option>Pueblo Nuevo</option>
                                <option>Salas</option>
                                <option>San José de los Molinos</option>
                                <option>San Juan Bautista</option>
                                <option>Santiago</option>
                                <option>Subtanjalla</option>
                                <option>Tate</option>
                                <option>Yauca del Rosario</option>
                                <option>Guadalupe</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="calle" class="fw-bold">Calle</label>
                            <input id="calle" class="form-control" type="text" name="calle">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="referencia" class="fw-bold">Referencia</label>
                            <input id="referencia" class="form-control" type="text" name="referencia">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnRegistrarDireccion">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Start Footer -->
<?php include 'Views/template/footer-principal.php'; ?>
<!-- End Footer-->

<script src="https://checkout.culqi.com/js/v4"></script>
<script>
    Culqi.publicKey = 'Aquí inserta tu llave pública';
</script>
<script src="<?php echo BASE_URL . 'assets/DataTables/datatables.min.js' ?>"></script>
<script src="<?php echo BASE_URL . 'assets/js/clientes.js' ?>"></script>
<script src="<?php echo BASE_URL . 'assets/js/modulos/agregarDireccion.js' ?>"></script>
<script src="<?php echo BASE_URL . 'assets/js/botonConfig.js' ?>"></script>
<!-- End Script -->
</body>

</html>