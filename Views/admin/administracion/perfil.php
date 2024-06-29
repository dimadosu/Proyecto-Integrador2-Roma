<?php include 'Views/template/header-admin.php' ?>

<div class="row">
    <div class="">
        <div class="card mb-4">
            <div class="card-header">
                <p class="text-center fw-bolder fs-2">Tus Datos</p>
            </div>
            <div class="card-body ms-4">
                <form action="" id="frmCuentaUsuario">
                    <div class="mb-3 row">
                        <input type="hidden" value="<?php echo $data['datos']['id'] ?>" id="id" name="id">
                        <label for="nombre" class="col-sm-2 col-form-label fw-semibold">Nombres</label>
                        <div class="col-sm-2">
                            <input id="nombre" name="nombre" type="text" class="form-control form-control-sm" value="<?php echo $data['datos']['nombres'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="apellidoPaterno" class="col-sm-2 col-form-label fw-semibold">Apellido Paterno</label>
                        <div class="col-sm-2">
                            <input id="apellidoPaterno" name="apellidoPaterno" type="text" class="form-control form-control-sm" value="<?php echo $data['datos']['apellido_paterno'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="apellidoMaterno" class="col-sm-2 col-form-label fw-semibold">Apellido Materno</label>
                        <div class="col-sm-2">
                            <input id="apellidoMaterno" name="apellidoMaterno" type="text" class="form-control form-control-sm" value="<?php echo $data['datos']['apellido_materno'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="correo" class="col-sm-2 col-form-label fw-semibold">Correo</label>
                        <div class="col-sm-4">
                            <input id="correo" name="correo" type="text" class="form-control form-control-sm" value="<?php echo $data['datos']['correo'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="celular" class="col-sm-2 col-form-label fw-semibold">Celular</label>
                        <div class="col-sm-4">
                            <input id="celular" name="celular" type="text" class="form-control form-control-sm" value="<?php echo $data['datos']['numero_celular'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="offset-sm-3 col-sm-2">
                            <button type="submit" class="btn btn-primary btn-sm" id="btnModificar">Modificar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'Views/admin/script.php' ?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/cuentaUsuario.js' ?>"></script>
</body>

</html>