<?php

class Proveedores extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Página Proveedores';
        $this->views->getView('admin/proveedores', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getProveedores();
    
        // Depuración: Verificar los datos obtenidos
        error_log(print_r($data, true));
    
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
                <button class="btn btn-primary ms-2 me-3" type="button" onclick="editProveedor(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger ms-2 me-3" type="button" onclick="eliminarProveedor(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
    
        // Depuración: Verificar el JSON que se va a enviar
        $json_data = json_encode(array("data" => $data), JSON_UNESCAPED_UNICODE);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('Error en la codificación JSON: ' . json_last_error_msg());
        }
        error_log($json_data);
    
        // Enviar la respuesta JSON
        header('Content-Type: application/json');
        echo $json_data; 
        die;
    }
    
    

    public function registrar()
    {
        if (isset($_POST['nombre_comercial'])) {
            $correo_contacto = $_POST['correo_contacto'];
            $nombre_comercial = $_POST['nombre_comercial'];
            $nombre_contacto = $_POST['nombre_contacto'];
            $numero_contacto = $_POST['numero_contacto'];
            $razon_social = $_POST['razon_social'];
            $ruc = $_POST['ruc'];
            $id = $_POST['id'];

            if (
                empty($_POST['correo_contacto']) || empty($_POST['nombre_comercial']) || empty($_POST['nombre_contacto']) ||
                empty($_POST['numero_contacto']) || empty($_POST['razon_social']) || empty($_POST['ruc'])
            ) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    $result = $this->model->verificarCorreo($correo_contacto);
                    if (empty($result)) {
                        $data = $this->model->registrar(
                            $correo_contacto,
                            $nombre_comercial,
                            $nombre_contacto,
                            $numero_contacto,
                            $razon_social,
                            $ruc
                        );
                        if ($data > 0) {
                            $respuesta = array('msg' => 'Proveedor Registrado', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'La cuenta con el correo ya existe', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar(
                        $correo_contacto,
                        $nombre_comercial,
                        $nombre_contacto,
                        $numero_contacto,
                        $razon_social,
                        $ruc,
                        $id
                    );
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Proveedor Actualizado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al actualizar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function eliminarProveedor($idProveedor)
    {
        if (is_numeric($idProveedor)) {
            $data = $this->model->eliminar($idProveedor);
            if ($data == 1) {
                $respuesta = array('msg' => 'Proveedor eliminado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error de campo id', 'icono' => 'error');
        }

        echo json_encode($respuesta);
        die();
    }

    public function edit($idProveedor)
    {
        if (is_numeric($idProveedor)) {
            $data = $this->model->getProveedor($idProveedor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
