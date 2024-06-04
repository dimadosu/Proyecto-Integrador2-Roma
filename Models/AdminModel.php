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
}