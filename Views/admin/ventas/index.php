<?php include 'Views/template/header-admin.php' ?>


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="vIniciadas-tab" data-bs-toggle="tab" data-bs-target="#ventasIniciadas" type="button" role="tab" aria-controls="ventasIniciadas" aria-selected="true">Iniciadas</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="vProcesos-tab" data-bs-toggle="tab" data-bs-target="#ventasProcesos" type="button" role="tab" aria-controls="ventasProcesos" aria-selected="false">Proceso</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="vEnviadas-tab" data-bs-toggle="tab" data-bs-target="#ventasEnviadas" type="button" role="tab" aria-controls="ventasEnviadas" aria-selected="false">Enviadas</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="ventasIniciadas" role="tabpanel" aria-labelledby="vIniciadas">
        <div class="card mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" style="width: 100%;" id="tableVentas">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Igv</th>
                                    <th>Importe</th>
                                    <th>Total</th>
                                    <th>Cliente</th>
                                    <th>Dni</th>
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
    </div>
    <div class="tab-pane fade" id="ventasProcesos" role="tabpanel" aria-labelledby="vProcesos-tab">
        <?php include 'Views/admin/ventas/ventasProceso.php' ?>
    </div>
    <div class="tab-pane fade" id="ventasEnviadas" role="tabpanel" aria-labelledby="vEnviadas-tab">
        <?php include 'Views/admin/ventas/ventasEnviadas.php' ?>
    </div>
</div>

<?php include 'Views/admin/script.php' ?>
<script src="<?php echo BASE_URL . 'assets/js/modulos/ventas.js' ?>"></script>
</body>

</html>