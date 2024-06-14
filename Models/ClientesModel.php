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

    public function modificar($nombre, $dni, $apePaterno, $apeMaterno, $celular, $correo, $id)
    {
        $consulta = "UPDATE clientes SET nombres=?, dni=?, apellido_paterno=?, apellido_materno=?, celular=?, correo=? WHERE id=?";
        $array = array($nombre,$dni, $apePaterno, $apeMaterno, $celular, $correo, $id);
        return $this->save($consulta, $array);
    }
}
