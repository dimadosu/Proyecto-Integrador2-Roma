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
    public function getCantidadVentaPorTipo($idEstado){
        $consulta = "SELECT count(*) as cantidad from ventas where id_tipo_proceso = $idEstado";
        return $this ->select($consulta);
    }

    //devuelve la cantidad de productos registrados
    public function getCantidadProductos(){
        $consulta = "SELECT count(*) as cantidad from productos;";
        return $this->select($consulta);
    }
}