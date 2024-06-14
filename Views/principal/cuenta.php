<?php include 'Views/template/header-principal.php' ?>

<!--info para mostrar-->
<div class="container mt-5 mb-5">
    <!--info-->
    <form action="" id="frmCuenta">
        <div class="mb-3 row">
            <input type="hidden" value="<?php echo $data['verificar']['id'] ?>" id="id" name="id">
            <label for="dni" class="col-sm-2 col-form-label">Dni</label>
            <div class="col-sm-2">
                <input id="dni" name="dni" type="text" class="form-control form-control-sm" value="<?php echo $data['verificar']['dni'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nombre" class="col-sm-2 col-form-label">Nombres</label>
            <div class="col-sm-2">
                <input id="nombre" name="nombre" type="text" class="form-control form-control-sm" value="<?php echo $data['verificar']['nombres'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="apellidoPaterno" class="col-sm-2 col-form-label">Apellido Paterno</label>
            <div class="col-sm-2">
                <input id="apellidoPaterno" name="apellidoPaterno" type="text" class="form-control form-control-sm" value="<?php echo $data['verificar']['apellido_paterno'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="apellidoMaterno" class="col-sm-2 col-form-label">Apellido Materno</label>
            <div class="col-sm-2">
                <input id="apellidoMaterno" name="apellidoMaterno" type="text" class="form-control form-control-sm" value="<?php echo $data['verificar']['apellido_materno'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="correo" class="col-sm-2 col-form-label">Correo</label>
            <div class="col-sm-4">
                <input id="correo" name="correo" type="text" class="form-control form-control-sm" value="<?php echo $data['verificar']['correo_electronico'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="celular" class="col-sm-2 col-form-label">Celular</label>
            <div class="col-sm-4">
                <input id="celular" name="celular" type="text" class="form-control form-control-sm" value="<?php echo $data['verificar']['numero_celular'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="offset-sm-3 col-sm-2">
                <button type="submit" class="btn btn-primary btn-sm" id="btnModificar">Modificar</button>
            </div>
        </div>
    </form>
</div>
<?php include 'Views/template/footer-principal.php' ?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/cuentaCliente.js' ?>"></script>
</body>

</html>