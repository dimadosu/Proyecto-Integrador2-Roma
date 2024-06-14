<?php include 'Views/template/header-admin.php' ?>

<button class="btn btn-primary mb-3" type="button" id="nuevo_registro">Nuevo Usuario</button>

<!--modaal de registro--->
<div id="modalUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="titleModal"></h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="frmRegistro">
                <div class="row modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="nombre" class="fw-bold">Nombres</label>
                            <input id="nombre" class="form-control" type="text" name="nombre">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="apePaterno" class="fw-bold">Apellido Paterno</label>
                            <input id="apePaterno" class="form-control" type="text" name="apePaterno">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="apeMaterno" class="fw-bold">Apellido Materno</label>
                            <input id="apeMaterno" class="form-control" type="text" name="apeMaterno">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="correo" class="fw-bold">Correo</label>
                            <input id="correo" class="form-control" type="email" name="correo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="celular" class="fw-bold">Celular</label>
                            <input id="celular" class="form-control" type="number" name="celular" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="clave" class="fw-bold">Contraseña</label>
                            <input id="clave" class="form-control" type="password" name="clave">
                        </div>
                    </div>
                    <div class="col-md-6 mx-auto">
                        <label for="rol" class="fw-bold">Rol</label>
                        <select class="form-control" name="rol" id="rol">
                            <option value="" >Seleccionar</option>
                            <?php foreach ($data['roles'] as $rol) { ?>
                                <option value="<?php echo $rol['id'] ?>"><?php echo $rol['nombre'] ?></option>
                            <?php } ?>
                        </select>
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
            <table class="table table-bordered table-striped table-hover" style="width: 100%;" id="tableUsuarios">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Nombres</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>Rol</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'Views/admin/script.php' ?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/usuarios.js' ?>"></script>
</body>

</html>