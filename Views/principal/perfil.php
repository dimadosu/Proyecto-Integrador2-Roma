<?php include 'Views/template/header-principal.php'; ?>

<!-- Start Content productos de la lista de deseo-->
<div class="container py-5">
    <div class="row">
        <!--VERIFICAMOS LA EXISTENCIA DEL CLIENTE-->
        <?php if ($data['verificar']['verificar'] == 1) { ?>
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
                        <p id="totalNeto" class="fw-normal"></p>
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
                        <?php } ?>

                    </div>
                </div>
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
</div>


<!-- Start Footer -->
<?php include 'Views/template/footer-principal.php'; ?>
<!-- End Footer -->

<script src="<?php echo BASE_URL . 'assets/js/clientes.js' ?>"></script>
<!-- End Script -->
</body>

</html>