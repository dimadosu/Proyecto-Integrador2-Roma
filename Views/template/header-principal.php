<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo TITLE . ' - ' . $data['title'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?php echo BASE_URL . 'assets/img/apple-icon.png'; ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL . 'assets/img/favicon.ico'; ?>">

    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/templatemo.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/custom.css'; ?>">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/fontawesome.min.css'; ?>">
    <!--
    
    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'assets/css/slick.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'assets/css/slick-theme.css' ?>">

    <!--link para las ventanas modales-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">

    <!--LINK DE PAYPAL--->
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo MONEDA ?>&components=buttons&enable-funding=venmo" data-sdk-integration-source="developer-studio"></script>

</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="<?php echo BASE_URL ?>">
                Tienda Roma
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL ?>">Principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL . 'principal/about' ?>">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL . 'principal/shop' ?>">Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL . 'principal/contactos' ?>">Contactanos</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <!--ENLACE QUE TIENE EL ICONO DE BUSQUEDA-->
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fas fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <!--PARA EVITAR MOSTRAR ESTOS ICONOS EN EL PROCESO DE COMPRA-->

                    <!--ENLACE QUE TIENE EL ICONO DE CARRITO-->
                    <a class="nav-icon position-relative text-decoration-none <?php echo ($data['perfil'] == 'no') ? '' : 'd-none'; ?>" href="#" id="verCarrito">
                        <i class="fas fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" id="btnCantidadCarrito">0</span>
                    </a>
                    <!--ENLACE QUE TIENE EL ICONO DE FAVORITOS-->
                    <a class="nav-icon position-relative text-decoration-none <?php echo ($data['perfil'] == 'no') ? '' : 'd-none'; ?>" href="<?php echo BASE_URL . 'principal/deseo' ?>">
                        <!--agregamos el btnCantidadDeseo, el estado cambia cuando se cliquea un producto a la lista -->
                        <i class="fas fa-fw fa-heart text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" id="btnCantidadDeseo">0</span>
                    </a>

                    <!--ENLACE QUE TIENE EL ICONO LOGIN-->
                    <?php if (!empty($_SESSION['correoCliente'])) { ?>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-fw fa-user text-dark mr-3"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL . 'clientes' ?>">Pago</a></li>
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL . 'clientes/salir' ?>">Cerrar Seción</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a class="nav-icon text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#modalLogin">
                            <i class="fas fa-fw fa-user text-dark mr-3"></i></a>
                        <?php } ?>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header data-bs-toggle="modal" data-bs-target="#modalLogin" -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>