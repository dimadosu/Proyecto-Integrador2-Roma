<?php

//clase controller que manda a mostrar las vistas 
class ClientesM extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
    }
    //vusta de inicio 
    public function index()
    {
        $data['title'] = 'Clientes';
        $this->views->getView('admin/clientes', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getClientes();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =  '<div class="d-flex">
                <button class="btn btn-primary ms-2 me-3" type="button" onclick="editCliente(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger ms-2 me-3" type="button" onclick="eliminarCliente(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data); //retornamos data
        die;
    }
    
}