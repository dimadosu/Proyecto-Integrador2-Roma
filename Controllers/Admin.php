<?php

//clase controller que manda a mostrar las vistas 
class Admin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    //vusta de inicio 
    public function index()
    {
        $data['title'] = 'Sistema-Control';
        $this->views->getView('admin', "login", $data);
    }

    //valida la existencia del usuario
    public function validar()
    {
        if (isset($_POST['email']) && isset($_POST['clave'])) {
            if (empty($_POST['email']) || empty($_POST['clave'])) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $data = $this->model->getUsuario($_POST['email']);
                if (empty($data)) {
                    $respuesta = array('msg' => 'El correo no existe', 'icono' => 'warning');
                } else {
                    if (password_verify($_POST['clave'], $data['clave'])) {
                        $_SESSION['correo'] = $data['correo'];
                        $_SESSION['idUser'] = $data['id'];
                        $respuesta = array('msg' => 'Ok', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Contraseña incorrecta', 'icono' => 'warning');
                    }
                }
            }
        } else {
            $respuesta = array('msg' => 'error', 'icono' => 'warning');
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die;
    }

    //Muestra la pantalla del admin
    public function home()
    {
        $data['title'] = 'Panel Administrativo';
        $data['inicida'] = $this->model->getCantidadVentaPorTipo(1);
        $data['proceso'] = $this->model->getCantidadVentaPorTipo(2);
        $data['enviada'] = $this->model->getCantidadVentaPorTipo(3);
        $data['cantProd'] = $this->model->getCantidadProductos();

        $data['mes'][0] = $this->model->getCantidadVentasXMes(1)['cantidad']; //Relacion 0posicion - 1mes Enero
        $data['mes'][1] = $this->model->getCantidadVentasXMes(2)['cantidad'];
        $data['mes'][2] = $this->model->getCantidadVentasXMes(3)['cantidad'];
        $data['mes'][3] = $this->model->getCantidadVentasXMes(4)['cantidad'];
        $data['mes'][4] = $this->model->getCantidadVentasXMes(5)['cantidad'];
        $data['mes'][5] = $this->model->getCantidadVentasXMes(6)['cantidad'];
        
        $this->views->getView('admin/administracion', "index", $data);
    }

    //metodo para cerrar la session
    public function salir()
    {
        session_destroy();

        header('Location: ' . BASE_URL . 'admin');
    }

    //ir a perfil
    public function perfil()
    {
        $data['title'] = 'Perfil';
        $data['datos'] = $this->model->getDatos($_SESSION['idUser']);
        $this->views->getView('admin/administracion', "perfil", $data);
    }

    //actualizar los datos personales 
    public function actualizarDatosPersonales()
    {
        if (isset($_POST['id'])) {
            //recuperando data del post
            $nombre = $_POST['nombre'];
            $apePaterno = $_POST['apellidoPaterno'];
            $apeMaterno = $_POST['apellidoMaterno'];
            $celular = $_POST['celular'];
            $correo = $_POST['correo'];
            $id = $_POST['id'];
            if (!empty($id)) {
                $data = $this->model->modificarDatosPersonales(
                    $nombre,
                    $apePaterno,
                    $apeMaterno,
                    $correo,
                    $celular,
                    $id
                );
                if ($data == 1) {
                    $respuesta = array('msg' => 'Datos Actualizados', 'icono' => 'success');
                } else {
                    $respuesta = array('msg' => 'Error al actualizar', 'icono' => 'error');
                }
            }
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //ir a la pagina para actualizar la clave
    public function clave()
    {
        $data['title'] = 'Configuracion-Clave';
        $this->views->getView('admin/administracion', "clave", $data);
    }

    public function cambiarClave()
    {
        if (isset($_POST['clave']) || isset($_POST['nuevaClave']) || isset($_POST['confirNuevaClave'])) {
            if (empty($_POST['clave']) || empty($_POST['nuevaClave']) || empty($_POST['confirNuevaClave'])) {
                $mensaje = array('msg' => 'Campos requeridos', 'icono' => 'warning');
            } else {
                $claveActual = $_POST['clave'];
                $nuevaClave = $_POST['nuevaClave'];
                $confirClave = $_POST['confirNuevaClave'];
                //validar la clave ingresa con la clave de bd
                $verificar = $this->model->getPassword($_SESSION['idUser']);
                if (!empty($verificar)) {
                    if (password_verify($claveActual, $verificar['clave'])) {
                        //verificar la pass nueva y la de confirmación
                        if (strcmp($nuevaClave, $confirClave) === 0) {
                            $hash = password_hash($confirClave, PASSWORD_DEFAULT);
                            $data = $this->model->actualizarClave($hash, $_SESSION['idUser']);
                            if ($data == 1) {
                                $mensaje = array('msg' => 'Clave Actualizada', 'icono' => 'success');
                            } else {
                                $mensaje = array('msg' => 'Error al actualizar', 'icono' => 'error');
                            }
                        } else {
                            $mensaje = array('msg' => 'La contraseña nueva y de confirmación no coinciden', 'icono' => 'error');
                        }
                    } else {
                        $mensaje = array('msg' => 'Contraseña incorrecta', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'Error fatal', 'icono' => 'warning');
                }
            }

            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function listarClientesTop()
    {
        $data = $this->model->getClientesTop();
        echo json_encode($data);
        die;
    }
}
