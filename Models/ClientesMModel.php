<?php
class ClientesMModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    //obtener la lista de todos los clientes
    public function getClientes()
    {
        $consulta = "SELECT  c.id, c.nombres, c.apellido_paterno, 
                        c.apellido_materno, c.dni, c.correo_electronico, 
                        c.numero_celular FROM clientes AS c;";
        return $this->selectAll($consulta);
    }
}
