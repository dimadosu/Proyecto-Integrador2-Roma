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

    
}