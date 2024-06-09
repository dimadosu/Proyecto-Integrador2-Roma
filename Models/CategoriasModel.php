<?php
class CategoriasModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    //obtenemos las categorias
    public function getCategorias()
    {
        $consulta = "SELECT * FROM categorias";
        return $this->selectAll($consulta);
    }

    public function registrar($nombre, $imagen)
    {
        $consulta = "INSERT INTO categorias (nombre, imagen) VALUES (?,?)";
        $array = array($nombre, $imagen);
        return $this->insertar($consulta, $array);
    }

    public function verificarCategoria($nombre)
    {
        $consulta = "SELECT nombre FROM categorias WHERE nombre = '$nombre'";
        return $this->select($consulta);
    }

    public function eliminar($id)
    {
        $consulta = "DELETE FROM categorias WHERE id = '$id'";
        return $this->delete($consulta);
    }

    //trae un usuario a partir del id
    public function getCategoria($id)
    {
        $consulta = "SELECT * FROM categorias WHERE  id = '$id'";
        return $this->select($consulta);
    }

    public function modificar($nombre, $imagen, $id)
    {
        $consulta = "UPDATE categorias SET nombre=?, imagen=? WHERE id=?";
        $array = array($nombre, $imagen, $id);
        return $this->save($consulta, $array);
    }
}
