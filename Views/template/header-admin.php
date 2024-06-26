<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo TITLE . ' - ' . $data['title'] ?></title>
    <link href="<?php echo BASE_URL; ?>assets/css/styles.css" rel="stylesheet" />
    <!--LINK DATATABLES--->
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-html5-3.0.2/b-print-3.0.2/r-3.0.2/datatables.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!--BARRA DE NAVEGACIÓN HORIZONTAL--->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?php echo BASE_URL . 'admin/home' ?>">Sistema Roma</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar Izquierda-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'admin/perfil' ?>">Perfil</a></li>
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'admin/clave'?>">Clave</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'admin/salir' ?>">Cerrar Session</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Módulos</div>
                        <!--Muestra la pagina de usuarios-->

                        <!--usuarios-->
                        <a class="nav-link" href="<?php echo BASE_URL . 'usuarios' ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Usuarios
                        </a>
                        <!--Clientes-->
                        <a class="nav-link" href="<?php echo BASE_URL . 'clientesM' ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Clientes
                        </a>
                        <!--categoria-->
                        <a class="nav-link" href="<?php echo BASE_URL . 'categorias' ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Categorías
                        </a>
                        <!--marca-->
                        <a class="nav-link" href="<?php echo BASE_URL . 'marcas' ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Marcas
                        </a>
                        <!--proveedores-->
                        <a class="nav-link" href="<?php echo BASE_URL . 'proveedores' ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Proveedores
                        </a>
                        <!--productos-->
                        <a class="nav-link" href="<?php echo BASE_URL . 'productos' ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            Productos
                        </a>

                        <!--ventas-->
                        <a class="nav-link" href="<?php echo BASE_URL . 'ventas' ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                            Ventas
                        </a>

                        <div class="sb-sidenav-menu-heading">Complementos</div>
                        <a class="nav-link" href="<?php echo BASE_URL . 'admin/home'?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Reportes
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Usuario con email:</div>
                    <?php echo $_SESSION['correo']?>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Distribuciones y Servicios Roma</h1>
