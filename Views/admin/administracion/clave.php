<?php include 'Views/template/header-admin.php' ?>

<div class="row">
    <div class="card mb-4">
        <div class="card-header">
            <p class="text-center fw-bolder fs-2">Cambiar Password</p>
        </div>
        <div class="card-body ms-4">
            <form action="" id="frmClaveUsuario">
                <div class="mb-3 row">
                    <input type="hidden" value="" id="id" name="id">
                    <label for="clave" class="col-sm-2 col-form-label">Contraseña Actual</label>
                    <div class="col-sm-4">
                        <input id="clave" name="clave" type="password" class="form-control form-control-sm" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nuevaClave" class="col-sm-2 col-form-label">Nueva Contraseña</label>
                    <div class="col-sm-4">
                        <input id="nuevaClave" name="nuevaClave" type="password" class="form-control form-control-sm" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="confirNuevaClave" class="col-sm-2 col-form-label">Repetir Contraseña</label>
                    <div class="col-sm-4">
                        <input id="confirNuevaClave" name="confirNuevaClave" type="password" class="form-control form-control-sm" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="offset-sm-3 col-sm-2">
                        <button type="submit" class="btn btn-primary btn-sm" id="btn">Modificar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include 'Views/admin/script.php' ?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/claveUsuario.js' ?>"></script>
</body>

</html>