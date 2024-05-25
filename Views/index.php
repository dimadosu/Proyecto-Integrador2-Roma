<?php include 'Views/template-principal/header.php'; ?>


<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="https://plazavea.vteximg.com.br/arquivos/ids/28196096-650-650/20235718.jpg" alt="imagen">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>Roma</b> Tienda Virtual </h1>
                            <h3 class="h2">Alicop</h3>
                            <p>
                                Zay Shop is an eCommerce HTML5 CSS template with latest version of Bootstrap 5 (beta 1).
                                This template is 100% free provided by
                                Image credits go to.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="https://plazavea.vteximg.com.br/arquivos/ids/28594257-650-650/929548.jpg" alt="imagen">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1 text-success"><b>Roma</b> Tienda Virtual </h1>
                            <h3 class="h2">Gloria</h3>
                            <p>
                                You are permitted to use this Zay CSS template for your commercial websites.
                                You are not permitted to re-distribute the template ZIP file in any kind of template collection websites.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="https://costenoalimentos.com.pe/media/1561/kNiKF9GysndDyGfXv1FjTuQGmi2Yvjsr4hlzYfMb.jpg" alt="imagen">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1 text-success"><b>Roma</b> Tienda Virtual </h1>
                            <h3 class="h2">Costeño </h3>
                            <p>
                                We bring you 100% free CSS templates for your websites.
                                If you wish to support TemplateMo, please make a small contribution via PayPal or tell your friends about our website. Thank you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Categorias</h1>
        </div>
    </div>
    <!-- listando las categorias de la bd-->
    <div class="row">
        <?php foreach ($data['categorias'] as $categoria) { ?>
            <div class="col-12 col-md-3 p-5 mt-3">
                <a href="<?php echo BASE_URL . 'principal/categorias/' . $categoria['id']; ?>">
                    <img src="<?php echo $categoria['imagen']; ?>" class="rounded-circle img-fluid border">
                </a>
                <h5 class="text-center mt-3 mb-3"><?php echo $categoria['nombre'] ?></h5>
            </div>
        <?php } ?>
    </div>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Algunos productos</h1>
            </div>
        </div>
        <!-- LISTANDO UNOS PRODUCTOS INICIALES-->
        <div class="row">
            <?php foreach ($data['productos'] as $producto) { ?>
                <div class="col-12 col-md-3 mb-4">
                    <div class="card h-100">
                        <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id'] ?>">
                            <img src="<?php echo $producto['imagen'] ?>" class="card-img-top" alt="<?php echo $producto['imagen'] ?>">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class=" text-right text-dark"><?php echo MONEDA . ' ' . $producto['precio'] ?></li>
                            </ul>
                            <p class="h2 text-decoration-none text-dark"><?php echo $producto['nombre_producto'] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- End Featured Product -->

<?php include 'Views/template-principal/footer.php'; ?>
</body>

</html>