<?php
date_default_timezone_set('UTC');

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
                $verificarDireccion = $this->model->verificarDireccion($verificar['id']);
                //verificamos que no se repita el mismo correo en el register 
                if (!empty($verificar)) { //si existe algo, hacer lo siguiente....
                    if (password_verify($clave, $verificar['clave'])) {
                        $_SESSION['correoCliente'] = $verificar['correo_electronico'];
                        $_SESSION['nombreCliente'] = $verificar['nombres'] . ' ' . $verificar['apellido_paterno'] . ' ' . $verificar['apellido_materno'];
                        $_SESSION['idCliente'] = $verificar['id'];
                        $_SESSION['direccion'] = $verificarDireccion;
                        $mensaje = array('msg' => 'ok', 'icono' => 'success', 'idCliente' => $verificar['id']);
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

    public function actualizarDatosPersonales()
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
            if (!empty($id)) {
                $data = $this->model->modificarDatosPersonales(
                    $nombre,
                    $dni,
                    $apePaterno,
                    $apeMaterno,
                    $celular,
                    $correo,
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

    public function direccion()
    {
        $data['perfil'] = 'no'; //variable para no mostrar el carrito en el proceso de compra
        $data['title'] = "Dirección de Envío";
        $data['verificar'] = $this->model->getDireccionCliente($_SESSION['idCliente']);
        $this->views->getView('principal', "direccion", $data);
    }

    public function agregarDireccion()
    {
        //validando envio del cliente al servidor 
        if (isset($_POST['distrito']) && isset($_POST['calle']) && isset($_POST['referencia'])) {
            $distrito = $_POST['distrito'];
            $calle =  $_POST['calle'];
            $referencia = $_POST['referencia'];
            $idCliente = $_POST['id'];
            //validando si existe dato 
            if (empty($_POST['distrito']) || empty($_POST['calle']) || empty($_POST['referencia'])) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $data = $this->model->registrarDireccion($distrito, $calle, $referencia, $idCliente);
                if ($data > 0) {
                    $respuesta = array('msg' => 'Direccion Registrada', 'icono' => 'success');
                    $verificarDireccion = $this->model->verificarDireccion($_SESSION['idCliente']);
                    $_SESSION['direccion'] = $verificarDireccion;
                } else {
                    $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actualizarDireccion()
    {
        if (isset($_POST['distrito']) && isset($_POST['calle']) && isset($_POST['referencia']) && isset($_POST['id'])) {
            //recuperando data del post
            $distrito = $_POST['distrito'];
            $calle = $_POST['calle'];
            $referencia = $_POST['referencia'];
            $id = $_POST['id'];
            if ($distrito != "" && $calle != "" && $referencia != "") {
                if (!empty($id)) {
                    $data = $this->model->modificarDireccion($distrito, $calle, $referencia, $id);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Direccion Actualizada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al actualizar', 'icono' => 'error');
                    }
                }
            } else {
                $respuesta = array('msg' => 'Campos Vacios', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Error fatal', 'icono' => 'warning');
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function password()
    {
        $data['perfil'] = 'no'; //variable para no mostrar el carrito en el proceso de compra
        $data['title'] = "Cambiar Contraseña";
        $data['verificar'] = $this->model->getPassword($_SESSION['idCliente']);
        $this->views->getView('principal', "clave", $data);
    }

    public function registrarPedidos()
    {
        $datos = file_get_contents('php://input');
        $venta = json_decode($datos, true);
        $productos = $venta['productos'];
        if (is_array($venta)) {
            $importe = $venta['totalEntrega'];
            $total = $venta['totalNeto'];
            $igv = 0.18;
            $idPago = 1;
            $idCliente = $_SESSION['idCliente'];
            $fecha = date("Y-m-d H:i:s");

            $data = $this->model->registrarPedido($fecha, $igv, $importe, $total, $idCliente, $idPago);

            if ($data > 0) {
                foreach ($productos as $producto) {
                    $cantidad = $producto['cantidad'];
                    $descripcion = $producto['nombre'];
                    $importe = $producto['subTotal'];
                    $precio = $producto['precio'];
                    $id_producto = $producto['id'];
                    $id_venta = $data;
                    $this->model->registrarDetalleVenta($cantidad, $descripcion, $importe, $precio, $id_producto, $id_venta);
                }
                $mensaje = array('msg' => 'Pedido registrado', 'icono' => 'success');
            } else {
                $mensaje = array('msg' => 'Error al registrar el pedido', 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Error fatal con los datos', 'icono' => 'error');
        }

        echo json_encode($mensaje);
        die();
    }

    //listar pedidos del cliente
    public function listarVenta($id)
    {
        $data = $this->model->getVentaPorIdCliente($id);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="text-center"> 
                                        <button class="btn btn-primary" type="button" onclick="verPedido(' . $data[$i]['id'] . ')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>';
        }
        echo json_encode($data);
        die();
    }

    //listar los detalles del pedido
    public function verPedido($id)
    {
        $data = $this->model->verDetallePedido($id);
        echo json_encode($data);
        die();
    }
}
