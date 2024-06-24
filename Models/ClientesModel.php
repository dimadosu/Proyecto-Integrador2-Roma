<?php
class ClientesModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    //funcion para registro de clientes
    public function registroCliente(
        $dni,
        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $celular,
        $correo,
        $clave,
        $token
    ) {

        $consulta = "INSERT INTO clientes (apellido_materno, apellido_paterno, clave ,
                        correo_electronico, dni, nombres, numero_celular, token) VALUES (?,?,?,?,?,?,?,?)";
        $datos = array($apellidoMaterno, $apellidoPaterno, $clave, $correo, $dni, $nombre, $celular, $token);
        $data = $this->insertar($consulta, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }

    //funcion para obtener token
    public function getToken($token)
    {
        //obtenemos el cliente que tiene token 
        $consulta = "SELECT * FROM clientes WHERE token = '$token'";
        return $this->select($consulta);
    }

    public function actualizarVerificar($id)
    {
        $consulta = "UPDATE clientes SET token=?, verificar=? WHERE id=?";
        $datos = array(null, 1, $id);
        $data = $this->save($consulta, $datos);
        if ($data == 1) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }

    //funcion para verificar el correo de los clientes 
    public function getVerificar($correo)
    {
        $consulta = "SELECT * FROM clientes WHERE correo_electronico = '$correo'";
        return $this->select($consulta);
    }

    //fuction para obtener la direccion del cliente 
    public function getDireccionCliente($id){
        $consulta = "SELECT * FROM direcciones WHERE id_cliente = $id";
        return $this ->select($consulta);
    }

    public function getPassword($id){
        $consulta = "SELECT id, clave FROM clientes WHERE id='$id'";
        return $this -> select($consulta);
    }

    public function verificarDireccion($idCliente)
    {
        $consulta = "SELECT D.id, D.calle , D.distrito , D.referencia , D.id_cliente FROM clientes AS C 
                        INNER JOIN direcciones AS D ON C.id = D.id_cliente AND C.id = '$idCliente'";
        return $this->select($consulta);
    }

    public function modificarDatosPersonales($nombre, $dni, $apePaterno, $apeMaterno, $celular, $correo, $id)
    {
        $consulta = "UPDATE clientes SET nombres=?, dni=?, apellido_paterno=?, apellido_materno=?, numero_celular=?, correo_electronico=? WHERE id=?";
        $array = array($nombre, $dni, $apePaterno, $apeMaterno, $celular, $correo, $id);
        return $this->save($consulta, $array);
    }

    public function modificarDireccion($distrito, $calle, $referencia, $id){
        $consulta = "UPDATE direcciones SET calle=?, distrito=?, referencia=? WHERE id_cliente=?";
        $array = array($calle, $distrito, $referencia, $id);
        return $this->save($consulta, $array);
    }

    public function registrarPedido($fecha, $igv, $importe, $total, $id_cliente, $id_pago)
    {
        $consulta = "INSERT INTO ventas (fecha, igv, importe, total, id_cliente, id_pago) VALUES (?,?,?,?,?,?)";
        $datos = array($fecha, $igv, $importe, $total, $id_cliente, $id_pago);
        $data = $this->insertar($consulta, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }

    public function registrarDetalleVenta($cantidad, $descripcion, $importe, $precio, $id_producto, $id_venta)
    {
        $consulta = "INSERT INTO detalle_ventas (cantidad, descripcion, importe, precio, id_producto, id_venta) VALUES (?,?,?,?,?,?)";
        $datos = array($cantidad, $descripcion, $importe, $precio, $id_producto, $id_venta);
        $data = $this->insertar($consulta, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }

    public function getVentaPorIdCliente($id){
        $consulta = "SELECT * FROM ventas WHERE id_cliente ='$id'";
        return $this->selectAll($consulta);
    }

    public function verDetallePedido($idVenta){
        $consulta = "SELECT * FROM detalle_ventas WHERE id_venta='$idVenta'";
        return $this->selectAll($consulta);
    }

    //registrar direccion
    public function registrarDireccion($distrito, $calle, $referencia, $idCliente){
        $consulta = "INSERT INTO direcciones (calle, distrito, referencia, id_cliente) values (?,?,?,?)";
        $datos = array($calle, $distrito, $referencia, $idCliente);
        $data = $this->insertar($consulta, $datos);
        if($data > 0){
            $res = $data;
        }else{
            $res = 0;
        }
        return $res;
    }
}
