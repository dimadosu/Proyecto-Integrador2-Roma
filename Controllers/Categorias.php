<?php

//clase controller que manda a mostrar las vistas 
class Categorias extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    //vista de  la pagina index de usuario
    public function index()
    {
        $data['title'] = 'Categorias';
        $this->views->getView('admin/categorias', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getCategorias();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="'.$data[$i]['imagen'].'" alt="'.$data[$i]['nombre'].'" width="50">';
            $data[$i]['accion'] =  '<div class="d-flex">
                <button class="btn btn-primary ms-2 me-3" type="button" onclick="editCat(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger ms-2 me-3" type="button" onclick="eliminarCat(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data); //retornamos data
        die;
    }

    public function registrar()
    {
        if (isset($_POST['categoria']) || isset($_POST['imagen'])) {
            $nombre = $_POST['categoria'];
            $imagen = $_FILES['imagen'];
            $tmp_name = $imagen['tmp_name'];
            $id = $_POST['id'];
            $ruta = 'assets/img/categorias/';
            $nombreImg = date('YmdHis');
            if (empty($_POST['categoria'])) {
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
                    $result = $this->model->verificarCategoria($nombre);
                    if (empty($result)) {
                        $data = $this->model->registrar($nombre, $destino);
                        if ($data > 0) {
                            if (!empty($imagen['name'])) {
                                move_uploaded_file($tmp_name, $destino);
                            }
                            $respuesta = array('msg' => 'Registro existoso', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'Error', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'La categoria ya existe', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar($nombre, $destino , $id);
                    if ($data == 1) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'Registro Actualizado', 'icono' => 'success');
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
    public function eliminarCategoria($idCat)
    {
        if (is_numeric($idCat)) {
            $data = $this->model->eliminar($idCat);
            if ($data == 1) {
                $respuesta = array('msg' => 'Registro eliminado', 'icono' => 'warning');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error de campo id', 'icono' => 'error');
        }

        echo json_encode($respuesta);
        die();
    }

    public function edit($idCat)
    {
        if (is_numeric($idCat)) {
            $data = $this->model->getCategoria($idCat);
            echo json_encode($data, JSON_UNESCAPED_UNICODE); //obtenemos el usuario de la bd
        }
        die();
    }
}
