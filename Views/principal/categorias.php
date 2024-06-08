<?php include 'Views/template/header-principal.php'; ?>

<!-- Start Content -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="h2 pb-4">Productos</h1>
        </div>
        <div class="col-lg-12">
            <!--MUESTRA TODOS LOS PRODUCTOS-->
            <div class="row">
                <?php foreach ($data['productos'] as $producto) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="<?php echo $producto['imagen']; ?>" width="300">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li>
                                            <!--ICONO DE CORAZON, PARA LISTA DE DESEOS-->
                                            <a class="btn btn-success text-white btnAddDeseo" href="#" prod="<?php echo $producto['id'];?>">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <!--ICONO DE OJITO, MUESTRA EL DETALLE DEL PRODUCTO-->
                                            <a class="btn btn-success text-white mt-2" href="<?php echo BASE_URL . 'principal/detail/' . $producto['id'];?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <!--ICONO DE CARRITO, PARA COMPRAR-->
                                            <a class="btn btn-success text-white mt-2 btnAddCarrito" href="#" prod="<?php echo $producto['id'];?>"> 
                                                <i class="fas fa-cart-plus"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id']?>" class="h3 text-decoration-none"><?php echo $producto['nombre_producto']?></a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                <ul class="list-unstyled d-flex justify-content-center mb-1">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                </ul>
                                <p class="text-center mb-0"><?php echo MONEDA . ' ' . $producto['precio'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <!--PAGINACION-->
            <div div="row">
                <ul class="pagination pagination-lg justify-content-end">
                    <?php
                    $anterior = $data['pagina'] - 1;
                    $siguiente = $data['pagina'] + 1;
                    $url = BASE_URL . 'principal/categorias/' . $data['id_categoria']; //url de la paginacion
                    if ($data['pagina'] > 1) {
                        echo '<li class="page-item ">
                            <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" 
                            href="' . $url . '/' . $anterior . '">Atrás</a>
                        </li>';
                    }
                    if ($data['total'] >= $siguiente) {
                        echo '<li class="page-item">
                            <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" 
                            href="' . $url . '/' . $siguiente . '">Siguiente</a>
                        </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- End Content -->

<!-- Start Brands -->
<section class="bg-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Nuestras Marcas</h1>
                <p>
                    Trabajamos de lado con los mejores marcas de
                    productos de consumo en Perú.
                </p>
            </div>
            <div class="col-lg-9 m-auto tempaltemo-carousel">
                <div class="row d-flex flex-row">
                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-light fas fa-chevron-left"></i>
                        </a>
                    </div>
                    <!--End Controls-->

                    <!--Carousel Wrapper-->
                    <div class="col">
                        <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example" data-bs-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_01.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_02.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_03.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_04.png" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End First slide-->

                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_01.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_02.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_03.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_04.png" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Second slide-->

                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_01.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_02.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_03.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL; ?>assets/img/brand_04.png" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Third slide-->

                            </div>
                            <!--End Slides-->
                        </div>
                    </div>
                    <!--End Carousel Wrapper-->

                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-light fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Brands-->


<!-- Start Footer -->
<?php include 'Views/template/footer-principal.php'; ?>
<!-- End Footer -->

<!-- End Script -->
</body>

</html>