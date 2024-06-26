<?php
class VentasModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    //obtenemos las categorias
    public function getVentas()
    {
        $consulta = "SELECT * FROM ventas";
        return $this->selectAll($consulta);
    }
    
}