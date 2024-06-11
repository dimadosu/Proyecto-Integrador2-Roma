<?php include 'Views/template/header-admin.php' ?>

<button class="btn btn-primary mb-3" type="button" id="nuevo_registro">Nuevo Proveedor</button>

<div id="modalProveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="titleModal"></h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmRegistro">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group mb-2">
                        <label for="correo_contacto" class="fw-bold">Correo Contacto</label>
                        <input id="correo_contacto" class="form-control" type="email" name="correo_contacto">
                    </div>
                    <div class="form-group mb-2">
                        <label for="nombre_comercial" class="fw-bold">Nombre Comercial</label>
                        <input id="nombre_comercial" class="form-control" type="text" name="nombre_comercial">
                    </div>
                    <div class="form-group mb-2">
                        <label for="nombre_contacto" class="fw-bold">Nombre Contacto</label>
                        <input id="nombre_contacto" class="form-control" type="text" name="nombre_contacto">
                    </div>
                    <div class="form-group mb-2">
                        <label for="numero_contacto" class="fw-bold">Número Contacto</label>
                        <input id="numero_contacto" class="form-control" type="text" name="numero_contacto">
                    </div>
                    <div class="form-group mb-2">
                        <label for="razon_social" class="fw-bold">Razón Social</label>
                        <input id="razon_social" class="form-control" type="text" name="razon_social">
                    </div>
                    <div class="form-group mb-2">
                        <label for="ruc" class="fw-bold">RUC</label>
                        <input id="ruc" class="form-control" type="text" name="ruc">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" style="width: 100%;" id="tableProveedores">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Correo Contacto</th>
                        <th>Nombre Comercial</th>
                        <th>Nombre Contacto</th>
                        <th>Número Contacto</th>
                        <th>Razón Social</th>
                        <th>RUC</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'Views/admin/script.php'?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/proveedores.js'?>"></script>
</body>

</html>
