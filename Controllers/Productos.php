<?php

//clase controller que manda a mostrar las vistas 
class Productos extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    //vista de  la pagina index de usuario
    public function index()
    {
        $data['title'] = 'Productos';
        $data['categorias'] = $this->model->getCategorias();
        $data['marcas'] = $this->model->getMarcas();
        $data['unidades'] = $this->model->getUnidades();
        $this->views->getView('admin/productos', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getProductos();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . $data[$i]['imagen'] . '" alt="' . $data[$i]['nombre_producto'] . '" width="50">';
            $data[$i]['accion'] =  '<div class="d-flex">
                <button class="btn btn-primary ms-2 me-3" type="button" onclick="editProd(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger ms-2 me-3" type="button" onclick="eliminarProd(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data); //retornamos data
        die;
    }

    public function registrar()
    {
        if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['idUser'])) {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $categoria = $_POST['categoria'];
            $marca = $_POST['marca'];
            $medida = $_POST['medida'];
            $imagen = $_FILES['imagen'];
            $user = $_POST['idUser'];
            $tmp_name = $imagen['tmp_name'];
            $id = $_POST['id'];
            $ruta = 'assets/img/productos/';
            $nombreImg = date('YmdHis');
            $fecha = "";
            if (
                empty($_POST['nombre']) || empty($_POST['precio']) || empty($_POST['cantidad']) || empty($_POST['categoria']) ||
                empty($_POST['marca']) || empty($_POST['medida']) || empty($_POST['idUser'])
            ) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                if (!empty($imagen['name'])) {
                    $destino = $ruta . $nombreImg . '.jpg';
                } else if (!empty($_POST['imagen_actual']) && empty($imagen['name'])) {
                    $destino = $_POST['imagen_actual'];
                } else {
                    $destino = $ruta . 'carrito.jpg';
                }

                if (empty($id)) {
                    $data = $this->model->registrar($nombre, $precio, $cantidad, $categoria, $marca, $medida, $destino, $user);
                    if ($data > 0) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'Producto existoso', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                    }
                } else {
                    $data = $this->model->modificar($nombre, $precio, $cantidad, $categoria, $marca, $medida, $destino, $user, $id);
                    if ($data == 1) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'Producto Actualizado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al actualizar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //error de ejecución->verficar luego
    public function eliminarProducto($idProd)
    {
        if (is_numeric($idProd)) {
            $data = $this->model->eliminar($idProd);
            if ($data == 1) {
                $respuesta = array('msg' => 'Registro eliminado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error de campo id', 'icono' => 'error');
        }

        echo json_encode($respuesta);
        die();
    }

    public function edit($idProd)
    {
        if (is_numeric($idProd)) {
            $data = $this->model->getProducto($idProd);
            echo json_encode($data, JSON_UNESCAPED_UNICODE); 
        }
        die();
    }
}
