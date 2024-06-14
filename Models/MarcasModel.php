<?php
class MarcasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    //obtenemos las marcas
    public function getMarcas()
    {
        $consulta = "SELECT M.id, M.nombre_marca , P.nombre_comercial FROM marcas AS M 
                    INNER JOIN proveedores AS P ON M.id_proveedor = P.id";
        return $this->selectAll($consulta);
    }

    public function getProveedores(){
        $consulta = "SELECT id, nombre_comercial FROM proveedores;";
        return $this->selectAll($consulta);
    }

    public function registrar($nombreMarca, $idProveedor)
    {
        $consulta = "INSERT INTO marcas (nombre_marca, id_proveedor) VALUES (?, ?)";
        $array = array($nombreMarca, $idProveedor);
        return $this->insertar($consulta, $array);
    }

    public function verificarNombre($nombreMarca)
    {
        $consulta = "SELECT nombre_marca FROM marcas WHERE nombre_marca = '$nombreMarca'";
        return $this->select($consulta);
    }

    public function eliminar($idMarca)
    {
        $consulta = "DELETE FROM marcas WHERE id = '$idMarca'";
        return $this->delete($consulta);
    }

    //trae una marca a partir del id
    public function getMarca($idMarca)
    {
        $consulta = "SELECT id, nombre_marca, id_proveedor FROM marcas WHERE id = '$idMarca'";
        return $this->select($consulta);
    }

    public function modificar($nombreMarca, $idProveedor, $id)
    {
        $consulta = "UPDATE marcas SET nombre_marca=?, id_proveedor=? WHERE id=?";
        $array = array($nombreMarca, $idProveedor, $id);
        return $this->save($consulta, $array);
    }
}
?>
