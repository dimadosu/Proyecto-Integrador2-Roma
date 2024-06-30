<?php

//clase controller que manda a mostrar las vistas 
class Principal extends Controller
{
    public function __construct()
    {
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
        $data['perfil'] = 'no';
        $data['title'] = 'Nosotros';
        $this->views->getView('principal', "about", $data);
    }
    //tienda 
    public function shop($page)
    {
        $data['perfil'] = 'no';
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
        $data['perfil'] = 'no';
        $data['producto'] = $this->model->getProducto($id_producto); //recuperamos data de funcion
        $data['title'] = $data['producto']['nombre_producto'];  //seleccinamos los datos
        $this->views->getView('principal', "detail", $data); //mandamos la vista y la data a monstrar
    }

    //productos de una categoria
    public function categorias($datos)
    {
        $data['perfil'] = 'no';
        $id_categoria = 1;
        $page = 1;
        $array = explode(',', $datos);
        if (isset($array[0])) {
            if (!empty($array[0])) {
                $id_categoria = $array[0];
            }
        }
        if (isset($array[1])) {
            if (!empty($array[1])) {
                $page = $array[1];
            }
        }

        $pagina = (empty($page)) ? 1 : $page; // validamos el envio de la número de paginacion
        $porPagina = 9; //cantida de productos por pagina
        $desde = ($pagina - 1) * $porPagina;

        $data['pagina'] = $pagina;
        $total = $this->model->getTotalProductosCat($id_categoria);
        $data['total'] = ceil($total['total'] / $porPagina);

        $data['productos'] = $this->model->getProductosCat($id_categoria, $desde, $porPagina); //recuperamos data de funcion
        $data['title'] = 'Categorias';  //seleccinamos los datos
        $data['id_categoria'] = $id_categoria;
        $this->views->getView('principal', "categorias", $data); //mandamos la vista y la data a monstrar
    }

    //conctacto
    //detalle del producto
    public function contactos()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Contacto';
        $this->views->getView('principal', "contact", $data);
    }

    //muestra la pagina de lista de deseo
    public function deseo()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Tu lista de deseo';
        $this->views->getView('principal', "deseo", $data);
    }

    //obtener productos a partir de la lista de deseo
    public function listaDeseo()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $array = array();
        foreach ($json as $producto) {
            # code...
            $result = $this->model->getListaDeseo($producto['idProducto']);
            //print_r($producto);
            $data['id'] =  $result['id'];
            $data['nombre'] =  $result['nombre_producto'];
            $data['precio'] =  $result['precio'];
            $data['cantidad'] =  $producto['cantidad']; //recuperamos la cantidad del producto html, no bd
            $data['imagen'] =  $result['imagen'];

            array_push($array, $data);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function listaProductos()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $array['productos'] = array();
        $total = 0.00;
        if (!empty($json)) {
            foreach ($json as $producto) {
                # code...
                $result = $this->model->getProducto($producto['idProducto']);
                //print_r($producto);
                $data['id'] =  $result['id'];
                $data['nombre'] =  $result['nombre_producto'];
                $data['precio'] =  $result['precio'];
                $data['cantidad'] =  $producto['cantidad']; //recuperamos la cantidad del producto html, no bd
                $subTotal = $result['precio'] * $producto['cantidad'];
                $data['imagen'] =  $result['imagen'];
                $data['subTotal'] = number_format($subTotal, 2);
                array_push($array['productos'], $data);
                $total = $total + $subTotal;
            }
        }

        $array['moneda'] = MONEDA;
        $array['total'] = number_format($total, 2);
        $array['totalEntrega'] = $total;
        $array['totalNeto'] = number_format(($total + ($total * 0.18)), 2);
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function busqueda($valor)
    {
        if ($valor != '') {
            $data = $this->model->getBusqueda($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
