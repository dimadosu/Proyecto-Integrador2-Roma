<?php
class ProveedoresModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProveedores()
    {
        $consulta = "SELECT id, correo_contacto, nombre_comercial, nombre_contacto, numero_contacto, razon_social, ruc FROM proveedores";
        return $this->selectAll($consulta);
    }
    

    public function registrar(
        $correo_contacto,
        $nombre_comercial,
        $nombre_contacto,
        $numero_contacto,
        $razon_social,
        $ruc
    ) {
        $consulta = "INSERT INTO proveedores (correo_contacto, nombre_comercial, nombre_contacto, numero_contacto, razon_social, ruc) 
                    VALUES (?,?,?,?,?,?)";
        $array = array(
            $correo_contacto,
            $nombre_comercial,
            $nombre_contacto,
            $numero_contacto,
            $razon_social,
            $ruc
        );
        return $this->insertar($consulta, $array);
    }

    public function verificarCorreo($correo_contacto)
    {
        $consulta = "SELECT correo_contacto FROM proveedores WHERE correo_contacto = '$correo_contacto'";
        return $this->select($consulta);
    }

    public function eliminar($idProveedor)
    {
        $consulta = "DELETE FROM proveedores WHERE id = '$idProveedor'";
        return $this->delete($consulta);
    }

    public function getProveedor($idProveedor)
    {
        $consulta = "SELECT id, correo_contacto, nombre_comercial, nombre_contacto, numero_contacto, razon_social, ruc FROM proveedores WHERE id = '$idProveedor'";
        return $this->select($consulta);
    }

    public function modificar(
        $correo_contacto,
        $nombre_comercial,
        $nombre_contacto,
        $numero_contacto,
        $razon_social,
        $ruc,
        $id
    ) {
        $consulta = "UPDATE proveedores SET correo_contacto=?, nombre_comercial=?, nombre_contacto=?, numero_contacto=?, razon_social=?, ruc=? WHERE id=?";
        $array = array($correo_contacto, $nombre_comercial, $nombre_contacto, $numero_contacto, $razon_social, $ruc, $id);
        return $this->save($consulta, $array);
    }
}
