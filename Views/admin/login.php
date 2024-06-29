<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $data['title']?></title>
        <link href="<?php echo BASE_URL; ?>assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form id="formulario" >
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" type="email" placeholder="Correo electronico" name="email"/>
                                                <label for="email">Correo electronico</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="clave" type="password" placeholder="Clave" name="clave"/>
                                                <label for="clave">Clave de acceso</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" href="#" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Distribuciones y Servicios Roma 2024</div>
                            <div>
                                <a href="#">Políticas de Privacidad</a>
                                &middot;
                                <a href="#">Términos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/scripts.js"></script>
        <script>
            const base_url= '<?php echo BASE_URL?>';
        </script>
        <script src="<?php echo BASE_URL?>assets/js/sweetalert2.all.min.js"></script>
        <script src="<?php echo BASE_URL?>assets/js/modulos/login.js"></script>
    </body>
</html>