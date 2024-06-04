<?php

//clase controller que manda a mostrar las vistas 
class Home extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
    }
    //vusta de inicio 
    public function index()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Pagina Principal';
        $data['categorias'] = $this->model->getCategorias();
        $data['productos'] = $this->model->getProductos();
        $this->views->getView('home', "index", $data);
    }

    
}