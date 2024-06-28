<?php
class ProductosModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    //obtenemos las categorias
    public function getProductos()
    {
        $consulta = "SELECT p.id, p.nombre_producto, p.precio, p.cantidad, c.nombre AS categoria, m.nombre_marca, u.nombre AS medida, p.fecha_vencimiento, p.imagen  
                    FROM productos AS P 
                    INNER JOIN categorias AS C ON p.id_categoria = c.id
                    INNER JOIN marcas AS m ON p.id_marca = m.id
                    INNER JOIN unidades_medida AS u ON p.id_unidad_medida = u.id 
                    ORDER BY p.id ";
        return $this->selectAll($consulta);
    }

    public function getMarcas()
    {
        $consulta = "SELECT * FROM marcas";
        return $this->selectAll($consulta);
    }

    public function getUnidades()
    {
        $consulta = "SELECT * FROM unidades_medida";
        return $this->selectAll($consulta);
    }

    public function getCategorias()
    {
        $consulta = "SELECT * FROM categorias";
        return $this->selectAll($consulta);
    }

    public function registrar($nombre, $precio, $cantidad, $categoria, $marca, $medida, $imagen, $user)
    {
        $consulta = "INSERT INTO productos (nombre_producto, precio, cantidad, id_categoria, id_marca, id_unidad_medida, imagen, id_usuario ) 
                    VALUES (?,?,?,?,?,?,?,?)";
        $array = array($nombre, $precio, $cantidad, $categoria, $marca, $medida, $imagen, $user);
        return $this->insertar($consulta, $array);
    }

    public function eliminar($id)
    {
        $consulta = "DELETE FROM productos WHERE id = '$id'";
        return $this->delete($consulta);
    }

    public function getProducto($idProd)
    {

        $consulta = "SELECT * FROM productos WHERE id='$idProd'";
        return $this->select($consulta);
    }

    public function modificar($nombre, $precio, $cantidad, $categoria, $marca, $medida, $imagen, $user, $id)
    {
        $consulta = "UPDATE productos SET nombre_producto=?, precio=?, cantidad=?, id_categoria=?, id_marca=?, id_unidad_medida=?, imagen=?, id_usuario=? WHERE id=?";
        $array = array($nombre, $precio, $cantidad, $categoria, $marca, $medida, $imagen, $user, $id);
        return $this->save($consulta, $array);
    }

    public function registrarEntrada($fecha, $cantidad, $idProducto)
    {
        $consulta = "INSERT INTO entrada_productos(fecha, stock, id_producto) VALUES (?,?,?)";
        $array = array($fecha, $cantidad, $idProducto);
        return $this->insertar($consulta, $array);
    }

    public function getEntradas(){
        $consulta = "SELECT  EP.id , P.nombre_producto, P.cantidad, EP.stock, EP.fecha FROM productos AS P 
                    INNER JOIN entrada_productos AS EP ON P.id = EP.id_producto order by EP.id desc;";
        return $this->selectAll($consulta);
    }

    public function getSalidas(){
        $consulta = "SELECT SP.id, P.nombre_producto, SP.cantidad, SP.fecha from productos AS P 
                    INNER JOIN salida_productos AS SP ON P.id = SP.id_producto ORDER BY SP.fecha DESC;";
        return $this->selectAll($consulta);
    }
    
    
}
