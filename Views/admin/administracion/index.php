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
                <p><?php echo $data['cantProd']['cantidad'] ?></p>
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
                Ventas de la semana
            </div>
            <div class="card-body">
                <?php
                //Variables obtenidas desde AdminController > AdminModel
                $meses_gfcArea = ["Ene", "Feb", "Mar", "Abr", "May", "Jun"];
                $ventas_gfcArea = $data['mes'];
                //Estas variables son utilizadas mas adelante en el script
                ?>
                <canvas id="miGraficoArea" width="100%" height="40"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Ventas por Mes
            </div>
            <div class="card-body">
                <?php
                //Variables obtenidas desde AdminController > AdminModel
                $meses_gfcBarras = ["Ene", "Feb", "Mar", "Abr", "May", "Jun"];
                $ventas_gfcBarras = $data['mes'];
                //Estas variables son utilizadas mas adelante en el script
                ?>
                <canvas id="miGraficoBarras" width="100%" height="40"></canvas>
            </div>
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
            <table id="tableClientesTop" class="table table-bordered table-striped table-hover" style="width: 100%;"">
                                    <thead>
                                        <tr>
                                            <th>Indice</th>
                                            <th>Cliente (ID)</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Cantidad de ventas</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>  
                                </table>
                            </div>
                        </div>
                    </div>
<?php include 'Views/template/footer-admin.php' ?>

<script>

var graficoBar = document.getElementById('miGraficoBarras').getContext('2d');
var miGraficoBar = new Chart(graficoBar, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($meses_gfcBarras); ?>,
        datasets: [{
            label: 'Ventas',
            data: <?php echo json_encode($ventas_gfcBarras); ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        legend: {
            display: false  // Hide the legend
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    max: Math.max(...<?php echo json_encode($ventas_gfcBarras); ?>) + 2
                }
            }]
        }
    }
});

var graficoArea = document.getElementById('miGraficoArea').getContext('2d');
var miGraficoArea = new Chart(graficoArea, {
    type: 'line',  // Use 'line' for area chart
    options: {
        legend: {
            display: false  // Hide the legend
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,  // Set minimum y-axis value
                    max: Math.max(...<?php echo json_encode($ventas_gfcArea); ?>) + 2
                }
            }]
        }
    },
    data: {
        labels: <?php echo json_encode($meses_gfcArea); ?>,
        datasets: [{
            label: 'Ventas',
            data: <?php echo json_encode($ventas_gfcArea); ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            fill: 'origin'
        }]
    }
});

//Tabla deUsuarios
document.addEventListener("DOMContentLoaded", function () {
  tblClientes = $("#tableClientesTop").DataTable({
    ajax: {
      url: base_url + "admin/listarClientesTop",
      dataSrc: "",
      error: function(xhr, status, error) {
        var err = eval("(" + xhr.responseText + ")");
        alert(err.Message);
      }

    },
    columns: [
      { data: "id" },
      { data: "nombres" },
      { data: "apellido_paterno" },
      { data: "apellido_materno" },
      { data: "dni" },
      { data: "cant_ventas" },
    ],
  });

});
</script>
</body>

</html>