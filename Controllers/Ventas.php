<?php

//clase controller que manda a mostrar las vistas 
class Ventas extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    //vista de  la pagina index de usuario
    public function index()
    {
        $data['title'] = 'Ventas';
        $this->views->getView('admin/ventas', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getVentas(1);

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =  '<div class="d-flex">
                <button class="btn btn-info ms-2 me-3" type="button" onclick="cambiarProceso(' . $data[$i]['id'] . ', 2)"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data); //retornamos data
        die;
    }

    public function listarVentasProceso()
    {
        $data = $this->model->getVentas(2);

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =  '<div class="d-flex">
                <button class="btn btn-info ms-2 me-3" type="button" onclick="cambiarProceso(' . $data[$i]['id'] . ', 3)"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data); //retornamos data
        die;
    }

    public function listarVentasEnviadas()
    {
        $data = $this->model->getVentas(3);
        
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =  '<div class="d-flex">
                <button class="btn btn-info ms-2 me-3" type="button" onclick="verVenta(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
            </div>';
        }
        echo json_encode($data); //retornamos data
        die;
    }

    public function actualizarProceso($datos){

        $array = explode(',' , $datos);
        $idVenta = $array[0];
        $idProceso = $array[1];
        if(is_numeric($idVenta)){
            $data = $this->model->actualizarTipoProceso($idProceso,$idVenta);
            if($data == 1){
                $respuesta = array('msg' => 'Estado de venta actualizado', 'icono' => 'success');
            }else{
                $respuesta = array('msg' => 'Error al cambiar estado', 'icono' => 'error');
            }
            echo json_encode($respuesta);
        }
        die();
    }
}
