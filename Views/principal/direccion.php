<?php include 'Views/template/header-principal.php' ?>

<!--info para mostrar-->
<div class="container mt-5 mb-5">
    <!--info-->
    <form action="" id="frmDireccion">
        <div class="mb-3 row">
            <input type="hidden" value="<?php echo $data['verificar']['id_cliente'] ?>" id="id" name="id">
            <label for="distrito" class="col-sm-2 col-form-label">Distrito</label>
            <div class="col-sm-4">
                <input id="distrito" name="distrito" type="text" class="form-control form-control-sm" value="<?php echo $data['verificar']['distrito'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="calle" class="col-sm-2 col-form-label">Calle</label>
            <div class="col-sm-4">
                <input id="calle" name="calle" type="text" class="form-control form-control-sm" value="<?php echo $data['verificar']['calle'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="referencia" class="col-sm-2 col-form-label">Referencia</label>
            <div class="col-sm-4">
                <input id="referencia" name="referencia" type="text" class="form-control form-control-sm" value="<?php echo $data['verificar']['referencia'] ?>">
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
<script src="<?php echo BASE_URL . 'assets/js/modulos/direccionCliente.js' ?>"></script>
</body>

</html>