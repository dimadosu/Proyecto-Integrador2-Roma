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
        $data = $this->model->getVentas();
        /*
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . $data[$i]['imagen'] . '" alt="' . $data[$i]['nombre_producto'] . '" width="50">';
            $data[$i]['accion'] =  '<div class="d-flex">
                <button class="btn btn-primary ms-2 me-3" type="button" onclick="editProd(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger ms-2 me-3" type="button" onclick="eliminarProd(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }*/
        echo json_encode($data); //retornamos data
        die;
    }
}
