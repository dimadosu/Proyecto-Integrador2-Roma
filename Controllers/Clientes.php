<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//clase controller que manda a mostrar las vistas 
class Clientes extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    //vusta de inicio 
    public function index()
    {
        //si no existe en la session el correo 
        if (empty($_SESSION['correoCliente'])) {
            header('Location: ' . BASE_URL);
        }
        $data['perfil'] = 'si'; //variable para no mostrar el carrito en el proceso de compra
        $data['title'] = 'Perfil';
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "perfil", $data);
    }

    //funcion para registar
    public function registroDirecto()
    {
        //print_r($_POST);
        //exit;
        if (isset($_POST['nombre']) && isset($_POST['clave']) && isset($_POST['dni']) && isset($_POST['correo'])) {
            if (empty($_POST['nombre']) || empty($_POST['clave']) || empty($_POST['dni']) || empty(isset($_POST['correo']))) {
                $mensaje = array('msg' => 'Campos requeridos', 'icono' => 'warning');
            } else {
                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $apellidoPaterno = $_POST['apellidoPaterno'];
                $apellidoMaterno = $_POST['apellidoMaterno'];
                $celular = $_POST['celular'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $verificar = $this->model->getVerificar($correo);
                //verificamos que no se repita el mismo correo en el register 
                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    //mandamos la data a la funcion de registro de clientes del modelo, que se conecta con los query
                    $data = $this->model->registroCliente(
                        $dni,
                        $nombre,
                        $apellidoPaterno,
                        $apellidoMaterno,
                        $celular,
                        $correo,
                        $hash,
                        $token
                    );
                    if ($data > 0) {
                        $_SESSION['correoCliente'] = $correo;
                        $_SESSION['nombreCliente'] = $nombre . ' ' . $apellidoPaterno . ' ' . $apellidoMaterno;
                        $mensaje = array('msg' => 'registrado con exito', 'icono' => 'success', 'token' => $token);
                    } else {
                        $mensaje = array('msg' => 'error al registrarse', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'Ya tienes una cuenta', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die;
        }
    }

    //funcion para enviar correo electronico y verifica
    public function enviarCorreo()
    {


        if (isset($_POST['correo']) && isset($_POST['token'])) {
            try {
                $mail = new PHPMailer(true);
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = USER_SMTP;                     //SMTP username
                $mail->Password   = PAS_SMTP;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('distribucionesroma07@gmail.com', TITLE); //correo de emisor
                $mail->addAddress($_POST['correo']);     //correo receptor

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Mensaje desde la: ' . TITLE;
                $mail->Body    = 'Para verificar tu correo en nuestra empresa <a href=" ' . BASE_URL . 'clientes/verificarCorreo/' . $_POST['token'] . '">CLICK AQUI</a>';
                $mail->AltBody = 'Gracias por ser nuestro cliente!';

                $mail->send();
                $mensaje = array('msg' => 'Correo enviado, revisar correo', 'icono' => 'success');
            } catch (Exception $e) {
                $mensaje = array('msg' => 'Error al enviar correo:' . $mail->ErrorInfo, 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Error fatal:', 'icono' => 'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die;
    }

    //se verifica la existencia del correo  en nuestra bd 
    public function verificarCorreo($token)
    {

        $verificar = $this->model->getToken($token);
        if (!empty($verificar)) {
            $data = $this->model->actualizarVerificar($verificar['id']);

            header('Location: ' . BASE_URL . 'clientes'); //mandamos a mostrar esta ruta 
        }
        //print_r($token);
    }

    public function loginDirecto()
    {
        if (isset($_POST['correoLogin']) && isset($_POST['claveLogin'])) {
            if (empty($_POST['correoLogin']) || empty($_POST['claveLogin'])) {
                $mensaje = array('msg' => 'Campos requeridos', 'icono' => 'warning');
            } else {
                $correo = $_POST['correoLogin'];
                $clave = $_POST['claveLogin'];
                $verificar = $this->model->getVerificar($correo);
                //verificamos que no se repita el mismo correo en el register 
                if (!empty($verificar)) { //si existe algo, hacer lo siguiente....
                    if (password_verify($clave, $verificar['clave'])) {
                        $_SESSION['correoCliente'] = $verificar['correo_electronico'];
                        $_SESSION['nombreCliente'] = $verificar['nombres'] . ' ' . $verificar['apellido_paterno'] . ' ' . $verificar['apellido_materno'];
                        $_SESSION['idCliente'] = $verificar['id'];
                        $mensaje = array('msg' => 'ok', 'icono' => 'success');
                    } else {
                        $mensaje = array('msg' => 'Contraseña incorrecta', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'El correo no existe', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die;
        }
    }

    //metodo para cerrar la session
    public function salir()
    {
        session_destroy();

        header('Location: ' . BASE_URL);
    }

    public function cuenta()
    {
        $data['perfil'] = 'no'; //variable para no mostrar el carrito en el proceso de compra
        $data['title'] = "Datos Personales";
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "cuenta", $data);
    }

    public function actualizar()
    {
        if (isset($_POST['nombre'])) {
            //recuperando data del post
            $nombre = $_POST['nombre'];
            $dni = $_POST['dni'];
            $apePaterno = $_POST['apellidoPaterno'];
            $apeMaterno = $_POST['apellidoMaterno'];
            $celular = $_POST['celular'];
            $correo = $_POST['correo'];
            $id = $_POST['id'];
            if (empty($id)) {
                $data = $this->model->modificar($nombre, $dni, $apePaterno,
                $apeMaterno, $celular, $correo, $id);
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
}
