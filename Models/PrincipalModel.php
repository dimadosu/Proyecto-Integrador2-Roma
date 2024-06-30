<?php
class PrincipalModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    //funcion de devuelve un producto a partir del id.
    //los datos del producto se muestran cuando haces click en la imagen.
    //el producto seleccionado se muestra en la vista detail del seleccionado
    public function getProducto($id_producto)
    {
        $consulta = "SELECT p.* , c.nombre FROM productos p 
        INNER JOIN categorias c ON 
        p.id_categoria = c.id
        WHERE p.id = $id_producto";
        return $this->select($consulta);
    }

    //devuelve los productos para mostrarlo en la pagina de tienda
    //solo algunos para hacer la paginacion
    public function getProductos($desde, $porPagina){
        $consulta = "SELECT * FROM productos LIMIT $desde, $porPagina";
        return $this->selectAll($consulta);
    }

    //obtener total de productos
    public function getTotalProductos(){
        $consulta = "SELECT COUNT(*) AS total FROM productos";
        return $this->select($consulta);
    }

    //obtener los productos de una categoria
    public function getProductosCat($id_categoria, $desde, $porPagina){
        $consulta = "SELECT * FROM productos WHERE id_categoria = $id_categoria LIMIT $desde , $porPagina";
        return $this->selectAll($consulta);
    }

    //obtener total de productos relacionados con la categoria 
    public function getTotalProductosCat($id_categoria){
        $consulta = "SELECT COUNT(*) AS total FROM productos WHERE id_categoria = $id_categoria";
        return $this->select($consulta);
    }

    //obtener productos a partir de la lista de deseo
    public function getListaDeseo($id_producto){
        $consulta = "SELECT * FROM productos WHERE id = $id_producto";
        return $this->select($consulta);
    }

    //busqueda de productos 
    public function getBusqueda($valor){
        $consulta = "SELECT * FROM productos WHERE nombre_producto LIKE '%" . $valor . "%'";
        return $this->selectAll($consulta);
    }
}
