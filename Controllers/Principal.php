<?php

//clase controller que manda a mostrar las vistas 
class Principal extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
    }
    //vusta de inicio 
    public function index()
    {
        /*
        $data['title'] = 'Pagina Principal';
        $this->views->getView('home', "index", $data);*/
    }
    //vista de nosotros
    public function about()
    {
        $data['title'] = 'Nosotros';
        $this->views->getView('principal', "about", $data);
    }
    //tienda 
    public function shop($page)
    {
        $pagina = (empty($page)) ? 1 : $page; // validamos el envio de la número de paginacion
        $porPagina = 9; //cantida de productos por pagina
        $desde = ($pagina - 1) * $porPagina;
        $data['title'] = 'Nuestros Productos';
        $data['productos'] = $this->model->getProductos($desde, $porPagina); //recuperamos los datos de la consulta
        $data['pagina'] = $pagina;
        $total = $this->model->getTotalProductos();
        $data['total'] = ceil($total['total'] / $porPagina);
        $this->views->getView('principal', "shop", $data); //mandamos la vista y los datos monstrar
    }

    //detalle del producto
    public function detail($id_producto)
    {
        $data['producto'] = $this ->model ->getProducto($id_producto); //recuperamos data de funcion
        $data['title'] = $data['producto']['nombre_producto'];  //seleccinamos los datos
        $this->views->getView('principal', "detail", $data); //mandamos la vista y la data a monstrar
    }

    //productos de una categoria
    public function categorias($datos)
    {
        $id_categoria = 1;
        $page = 1;
        $array = explode(',', $datos);
        if(isset($array[0])){
            if(!empty($array[0])){
                $id_categoria = $array[0];
            }
        }
        if(isset($array[1])){
            if(!empty($array[1])){
                $page = $array[1];
            }
        }

        $pagina = (empty($page)) ? 1 : $page; // validamos el envio de la número de paginacion
        $porPagina = 9; //cantida de productos por pagina
        $desde = ($pagina - 1) * $porPagina;

        $data['pagina'] = $pagina;
        $total = $this->model->getTotalProductosCat($id_categoria);
        $data['total'] = ceil($total['total'] / $porPagina);

        $data['productos'] = $this ->model ->getProductosCat($id_categoria ,$desde, $porPagina); //recuperamos data de funcion
        $data['title'] = 'Categorias';  //seleccinamos los datos
        $data['id_categoria'] = $id_categoria;
        $this->views->getView('principal', "categorias", $data); //mandamos la vista y la data a monstrar
    }

    //conctacto
    //detalle del producto
    public function contactos()
    {
        $data['title'] = 'Contacto';
        $this->views->getView('principal', "contact", $data);
    }


}