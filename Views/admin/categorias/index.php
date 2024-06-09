<?php include 'Views/template/header-admin.php' ?>

<button class="btn btn-primary mb-3" type="button" id="nuevo_registro">Nueva Categoría</button>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mx-auto" style="width: 90%;" id="tblCategorias">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalCategoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
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
                    <input type="hidden" id="imagen_actual" name="imagen_actual">
                    <div class="form-group mb-2">
                        <label for="categoria" class="fw-bold">Nombre</label>
                        <input id="categoria" class="form-control" type="text" name="categoria">
                    </div>
                    <div class="form-group mb-2">
                        <label for="imagen" class="fw-bold">Imagen(Opcional)</label>
                        <input id="imagen" class="form-control" type="file" name="imagen">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'Views/admin/script.php' ?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/categorias.js'?>"></script>
</body>
</html>