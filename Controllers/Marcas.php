<?php

class Marcas extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Página Marcas';
        $this->views->getView('admin/marcas', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getMarcas();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
                <button class="btn btn-primary ms-2 me-3" type="button" onclick="editMarca(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger ms-2 me-3" type="button" onclick="eliminarMarca(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data);
        die;
    }

    public function registrar()
    {
        if (isset($_POST['nombre_marca'])) {
            $nombreMarca = $_POST['nombre_marca'];
            $idProveedor = $_POST['id_proveedor'];
            $id = $_POST['id'];

            if (empty($nombreMarca) || empty($idProveedor)) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    $data = $this->model->registrar($nombreMarca, $idProveedor);
                    if ($data > 0) {
                        $respuesta = array('msg' => 'Marca Registrada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                    }
                } else {
                    $data = $this->model->modificar($nombreMarca, $idProveedor, $id);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Marca Actualizada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al actualizar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function eliminarMarca($idMarca)
    {
        if (is_numeric($idMarca)) {
            $data = $this->model->eliminar($idMarca);
            if ($data == 1) {
                $respuesta = array('msg' => 'Marca eliminada', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error de campo id', 'icono' => 'error');
        }

        echo json_encode($respuesta);
        die();
    }

    public function edit($idMarca)
    {
        if (is_numeric($idMarca)) {
            $data = $this->model->getMarca($idMarca);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
?>
