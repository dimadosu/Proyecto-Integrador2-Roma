<?php

//clase controller que manda a mostrar las vistas 
class Usuarios extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    //vista de  la pagina index de usuario
    public function index()
    {
        $data['title'] = 'Pagina Usuarios';
        $this->views->getView('admin/usuarios', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =  '<div class="d-flex">
                <button class="btn btn-primary ms-2 me-3" type="button" onclick="editUser(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger ms-2 me-3" type="button" onclick="eliminarUser(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data); //retornamos data
        die;
    }

    public function registrar()
    {
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $apellidoPaterno = $_POST['apePaterno'];
            $apellidoMaterno = $_POST['apeMaterno'];
            $celular = $_POST['celular'];
            $correo = $_POST['correo'];
            $clave = password_hash(($_POST['clave']), PASSWORD_DEFAULT);
            $id = $_POST['id'];

            if (
                empty($_POST['nombre']) || empty($_POST['apePaterno']) || empty($_POST['apeMaterno']) ||
                empty($_POST['correo'] || empty($_POST['celular']) || empty($_POST['clave']))
            ) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    $result = $this->model->verificarCorreo($correo);
                    if (empty($result)) {
                        $data = $this->model->registrar(
                            $nombre,
                            $apellidoPaterno,
                            $apellidoMaterno,
                            $celular,
                            $correo,
                            $clave
                        );
                        if ($data > 0) {
                            $respuesta = array('msg' => 'Usuario Registrado', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'La cuenta con el correo ya existe', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar(
                        $nombre,
                        $apellidoPaterno,
                        $apellidoMaterno,
                        $celular,
                        $correo,
                        $id
                    );
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Usuario Actualizado', 'icono' => 'success');
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
    public function eliminarUsuario($idUser)
    {
        if (is_numeric($idUser)) {
            $data = $this->model->eliminar($idUser);
            if ($data == 1) {
                $respuesta = array('msg' => 'Usuario eliminado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error de campo id', 'icono' => 'error');
        }

        echo json_encode($respuesta);
        die();
    }

    public function edit($idUser)
    {
        if (is_numeric($idUser)) {
            $data = $this->model->getUsuario($idUser);
            echo json_encode($data, JSON_UNESCAPED_UNICODE); //obtenemos el usuario de la bd
        }
        die();
    }
}
