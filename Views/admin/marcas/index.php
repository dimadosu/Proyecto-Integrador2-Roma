<?php include 'Views/template/header-admin.php' ?>

<button class="btn btn-primary mb-3" type="button" id="nuevo_registro">Nueva Marca</button>

<!--modal de registro-->
<div id="modalMarca" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="titleModal"></h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">   
                </button>
            </div>
            <form id="frmRegistro">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group mb-2">
                        <label for="nombre_marca" class="fw-bold">Nombre Marca</label>
                        <input id="nombre_marca" class="form-control" type="text" name="nombre_marca">
                    </div>
                    <div class="form-group mb-2">
                        <label for="id_proveedor" class="fw-bold">ID Proveedor</label>
                        <input id="id_proveedor" class="form-control" type="text" name="id_proveedor">
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
            <table class="table table-bordered table-striped table-hover" style="width: 100%;" id="tableMarcas">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Nombre Marca</th>
                        <th>ID Proveedor</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'Views/admin/script.php' ?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/marcas.js' ?>"></script>
</body>
</html>
