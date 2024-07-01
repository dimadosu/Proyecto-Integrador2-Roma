<?php include 'Views/template/header-admin.php' ?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#listaProducto" type="button" role="tab" aria-controls="listaProducto" aria-selected="true">Productos</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#entradas" type="button" role="tab" aria-controls="entradas" aria-selected="false">Entradas</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#salidas" type="button" role="tab" aria-controls="salidas" aria-selected="false">Salidas</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#nuevoProducto" type="button" role="tab" aria-controls="nuevoProducto" aria-selected="false">Nuevo</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="listaProducto" role="tabpanel" aria-labelledby="home-tab">
        <div class="card mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover mx-auto" style="width: 100%;" id="tblProductos">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Categoria</th>
                                <th>Marca</th>
                                <th>Uni.Medida</th>
                                <th>Fech.Venc</th>
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
    </div>
    <div class="tab-pane fade" id="nuevoProducto" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card mt-4">
            <div class="card-body">
                <form id="frmRegistro">
                    <div class="row">
                        <input type="hidden" id="idUser" name="idUser" value="<?php echo $_SESSION['idUser'] ?>">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="imagen_actual" name="imagen_actual">
                        <div class="col-md-5">
                            <div class="form-group mb-2">
                                <label for="nombre" class="fw-bold">Nombre del producto</label>
                                <input id="nombre" class="form-control" type="text" name="nombre">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="precio" class="fw-bold">Precio</label>
                                <input id="precio" class="form-control" type="text" name="precio" onKeypress="if (event.keyCode < 46 || event.keyCode > 57) event.returnValue = false;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="cantidad" class="fw-bold">Cantidad</label>
                                <input id="cantidad" class="form-control" type="text" name="cantidad" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="categoria" class="fw-bold">Categorias</label>
                                <select class="form-control" name="categoria" id="categoria">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['categorias'] as $categoria) { ?>
                                        <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="marca" class="fw-bold">Marca</label>
                                <select class="form-control" name="marca" id="marca">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['marcas'] as $marca) { ?>
                                        <option value="<?php echo $marca['id'] ?>"><?php echo $marca['nombre_marca'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="medida" class="fw-bold">Uni. Medida</label>
                                <select class="form-control" name="medida" id="medida">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['unidades'] as $unidad) { ?>
                                        <option value="<?php echo $unidad['id'] ?>"><?php echo $unidad['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="imagen" class="fw-bold">Imagen</label>
                                <input id="imagen" class="form-control" type="file" name="imagen">
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div  class="tab-pane fade" id="entradas" role="tabpanel" aria-labelledby="profile-tab">
        <?php include 'Views/admin/productos/entradas.php'?>
    </div>
    <div  class="tab-pane fade" id="salidas" role="tabpanel" aria-labelledby="profile-tab">
            <?php include 'Views/admin/productos/salidas.php'?>
    </div>
</div>

<?php include 'Views/admin/script.php' ?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/productos.js' ?>"></script>
<script src="<?php echo BASE_URL . 'assets/js/modulos/salida.js'?>"></script>
</body>

</html>