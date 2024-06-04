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
        $this->views->getView('admin/control', "index", $data);
    }

    //metodo para cerrar la session
    public function salir()
    {
        session_destroy();

        header('Location: ' . BASE_URL . 'admin');
    }
}
