<?php
class HomeModel extends Query
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

    //obtenemos los productos 
    public function getProductos()
    {
        $consulta = "SELECT * FROM productos LIMIT 8";
        return $this->selectAll($consulta);
    }
}
