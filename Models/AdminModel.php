<?php
class AdminModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    //obtenemos al usuario
    public function getUsuario($correo)
    {
        $consulta = "SELECT * FROM usuarios WHERE correo = '$correo'";
        return $this->select($consulta);
    }

    //devuelve la cantidad de tipo de ventas en proceso
    public function getCantidadVentaPorTipo($idEstado)
    {
        $consulta = "SELECT count(*) as cantidad from ventas where id_tipo_proceso = $idEstado";
        return $this->select($consulta);
    }

    //devuelve la cantidad de productos registrados
    public function getCantidadProductos()
    {
        $consulta = "SELECT count(*) as cantidad from productos;";
        return $this->select($consulta);
    }

    //Devuelve la cantidad de productos segun el mes ingresado (mes por numero)
    public function getCantidadVentasXMes($mes)
    {
        $consulta = "SELECT count(*) as cantidad FROM ventas WHERE MONTH(fecha) = $mes";
        return $this->select($consulta);
    }

    public function getClientesTop()
    {
        $consulta = "SELECT u.id, u.nombres, u.apellido_paterno, u.apellido_materno, u.dni, v.cant_ventas FROM
            ( 
                SELECT id_cliente, COUNT(*) as cant_ventas FROM ventas GROUP BY id_cliente ORDER BY cant_ventas DESC
            ) as v
            JOIN clientes as u on v.id_cliente = u.id";
        return $this->selectAll($consulta);
    }

    //Devuelve la cantidad de producto segun _____dia?_______
    public function getCandidadVentasXDia($dia)
    {

    }
    
    //obtener datos personales del usuario 
    public function getDatos($id)
    {
        $consulta = "SELECT u.id, u.nombres, u.apellido_paterno, u.apellido_materno, u.correo, u.numero_celular 
                    from usuarios as u WHERE id = '$id'";
        return $this->select($consulta);
    }


    public function modificarDatosPersonales($nombre,$apePaterno,$apeMaterno,$correo,$celular,$id
    ) {
        $consulta = "UPDATE usuarios SET nombres=?,apellido_paterno=?, apellido_materno=?, correo=?, numero_celular=? WHERE id=?";
        $datos = array($nombre, $apePaterno, $apeMaterno, $correo, $celular, $id);
        return $this->save($consulta, $datos);
    }
    
    //obtener pass para comparar
    public function getPassword($id){
        $consulta = "SELECT id, clave FROM usuarios WHERE id='$id'";
        return $this -> select($consulta);
    }

    //actualizar clave
    public function actualizarClave($clave, $idUser){
        $consulta = "UPDATE usuarios SET clave=? WHERE id=?";
        $data = array($clave, $idUser);
        return $this->save($consulta,$data);
    }
}
