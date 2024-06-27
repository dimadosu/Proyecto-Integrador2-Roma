<?php include 'Views/template/header-admin.php' ?>
<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary  mb-4">
            <div class="card-body">
                <h5>Ventas Iniciadas</h5>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <p><?php echo $data['inicida']['cantidad'] ?></p>
                <div class="small text-white"><i class="fas fa-info"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning  mb-4">
            <div class="card-body">
                <h5>Ventas en Proceso</h5>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <p><?php echo $data['proceso']['cantidad'] ?></p>
                <div class="small text-white"><i class="fas fa-info"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success mb-4">
            <div class="card-body">
                <h5>Ventas Enviadas</h5>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <p><?php echo $data['enviada']['cantidad'] ?></p>
                <div class="small text-white"><i class="fas fa-info"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger mb-4">
            <div class="card-body">
                <h5>Total de Productos</h5>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <p ><?php echo $data['cantProd']['cantidad'] ?></p>
                <div class="small text-white"><i class="fas fa-list"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Area Chart Example
            </div>
            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Bar Chart Example
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Clientes Top
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatablesSimple" class="table table-bordered table-striped table-hover" style="width: 100%;"">
                                    <thead>
                                        <tr>
                                            <th>Indice</th>
                                            <th>Cliente (ID)</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Cantidad de ventas</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>  
                                </table>
                            </div>
                        </div>
                    </div>
<?php include 'Views/template/footer-admin.php' ?>
</body>

</html>