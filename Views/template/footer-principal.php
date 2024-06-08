<!--MUESTRA LA LISTA DE PRODUCTOS del carrito modal--->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title"><i class="fas fa-fw fa-cart-arrow-down text-dark mr-1"></i>Carrito</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-border table-striped table-hover align-middle" id="tableListaCarrito">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Precio(S/.)</th>
                                <th>Cantidad</th>
                                <th>Importe(S/.)</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-around mb-3">
                <p id="totalGeneral" class="text-dark fw-bold "></p>
                <!--validamos la session del correo para seguir con la compra-->
                <?php if (!empty($_SESSION['correoCliente'])) { ?>
                    <a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'clientes' ?>">Procesar Pedido</a>
                <?php } else { ?>
                    <a class="btn btn-outline-primary" href="#" onclick="abrirModalLogin()">Login</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!--LOGIN DIRECTO-->
<div id="modalLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-center" id="titleLogin">Iniciar Sesión</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-12" id="frmLogin">
                            <div class="form-group mb-3">
                                <label for="correoLogin" class="fw-bold"><i class="fas fa-envelope"></i> Correo</label>
                                <input id="correoLogin" class="form-control" type="text" name="correoLogin" placeholder="correo">
                            </div>
                            <div class="form-group mb-3">
                                <label for="claveLogin" class="fw-bold"><i class="fas fa-key"></i> Clave</label>
                                <input id="claveLogin" class="form-control" type="password" name="claveLogin" placeholder="password">
                            </div>
                            <a href="#" id="btnRegister">No tienes cuenta?, click para crear una</a>
                            <div class="float-end">
                                <button class="btn btn-primary" type="button" id="login">Login</button>
                            </div>
                        </div>
                        <!--FORMULARIO DE REGISTRO DE CLIENTE-->
                        <div class="row g-3 d-none" id="frmRegister">
                            <div class="form-group  col-md-6">
                                <label for="dniRegistro" class="fw-bold">Dni</label>
                                <input id="dniRegistro" class="form-control" type="text" name="dniRegistro" placeholder="Dni">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombreRegistro" class="fw-bold">Nombres</label>
                                <input id="nombreRegistro" class="form-control" type="text" name="nombreRegistrp" placeholder="Nombres">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apePaternoRegistro" class="fw-bold">Apellido Paterno</label>
                                <input id="apePaternoRegistro" class="form-control" type="text" name="apePaternoRegistro" placeholder="Apellido Paterno">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="apeMaternoRegistro" class="fw-bold">Apellido Materno</label>
                                <input id="apeMaternoRegistro" class="form-control" type="text" name="apeMaternoRegistro" placeholder="Apellido Materno">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="celularRegistro" class="fw-bold">Celular</label>
                                <input id="celularRegistro" class="form-control" type="text" name="correoRegistro" placeholder="Celular">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="correoRegistro" class="fw-bold">Correo</label>
                                <input id="correoRegistro" class="form-control" type="text" name="correoRegistro" placeholder="Correo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="claveRegistro" class="fw-bold">Clave</label>
                                <input id="claveRegistro" class="form-control" type="password" name="claveRegistro" placeholder="Clave">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="float-end">
                                    <a href="#" id="btnLogin">Ir a login</a>
                                    <button class="btn btn-primary" type="button" id="registrarse">Registrarse</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Start Footer -->
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo">Tienda Roma</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        123 Consectetur at ligula 10660
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <a class="text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <a class="text-decoration-none" href="mailto:info@company.com">info@roma.com</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Productos</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="#">Arroz</a></li>
                    <li><a class="text-decoration-none" href="#">Azucar</a></li>
                    <li><a class="text-decoration-none" href="#">Bebidas</a></li>
                    <li><a class="text-decoration-none" href="#">Bebidas Alcholicas</a></li>
                    <li><a class="text-decoration-none" href="#">Dulces</a></li>
                    <li><a class="text-decoration-none" href="#">Helados</a></li>
                    <li><a class="text-decoration-none" href="#">Mucho más!</a></li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Información</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="#">Principal</a></li>
                    <li><a class="text-decoration-none" href="#">Nosotros</a></li>
                    <li><a class="text-decoration-none" href="#">Tienda</a></li>
                    <li><a class="text-decoration-none" href="#">Contactanos</a></li>
                </ul>
            </div>

        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">
                        Copyright &copy; 2024 Distribuciones y Servicios Roma
                        | Desarrollado por <a rel="sponsored" href="https://pe.linkedin.com/company/distribuciones-y-servicios-roma" target="_blank">Roma</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- End Footer -->

<!-- Start Script -->
<script src="<?php echo BASE_URL; ?>assets/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/templatemo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
<script>
    const base_url = '<?php echo BASE_URL ?>';
</script>
<script src="<?php echo BASE_URL; ?>assets/js/carrito.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/login.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/custom.js"></script>

<!-- End Script -->