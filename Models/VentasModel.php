<?php
class VentasModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    //obtenemos las categorias
    public function getVentas($id_proceso)
    {
        $consulta = "SELECT  v.id,v.fecha, v.igv, v.importe, v.total, 
		            concat_WS(' ' , c.nombres, c.apellido_paterno, c.apellido_materno) as cliente , c.dni
                    FROM clientes AS c 
                    INNER JOIN ventas AS v ON c.id = v.id_cliente AND v.id_tipo_proceso = $id_proceso ORDER BY v.id DESC";
        return $this->selectAll($consulta);
    }

    public function actualizarTipoProceso($id_proceso ,$idVenta){
        $consulta = "UPDATE ventas SET id_tipo_proceso = ? WHERE id = ?";
        $array = array($id_proceso, $idVenta);
        return $this->save($consulta, $array);
    }
}
