<?php
class UsuariosModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    //obtenemos las categorias
    public function getUsuarios()
    {
        $consulta = "SELECT id, nombres, apellido_paterno, apellido_materno, correo, numero_celular, id_rol FROM usuarios";
        return $this->selectAll($consulta);
    }

    public function registrar(
        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $celular,
        $correo,
        $clave
    ) {

        $consulta = "INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, numero_celular, correo, clave, id_rol) 
                    VALUES (?,?,?,?,?,?,2)";
        $array = array(
            $nombre,
            $apellidoPaterno,
            $apellidoMaterno,
            $celular,
            $correo,
            $clave
        );
        return $this->insertar($consulta, $array);
    }

    public function verificarCorreo($correo)
    {
        $consulta = "SELECT correo FROM usuarios WHERE correo = '$correo'";
        return $this->select($consulta);
    }

    public function eliminar($idUser)
    {
        $consulta = "DELETE FROM usuarios WHERE id = '$idUser'";
        return $this->delete($consulta);
    }

    //trae un usuario a partir del id
    public function getUsuario($idUser)
    {
        $consulta = "SELECT id, nombres, apellido_paterno, apellido_materno, correo, numero_celular FROM usuarios WHERE  id = '$idUser'";
        return $this->select($consulta);
    }

    public function modificar(
        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $celular,
        $correo,
        $id
    ) {
        $consulta = "UPDATE usuarios SET nombres=?, apellido_paterno=?, apellido_materno=?, correo=?, numero_celular=? WHERE id=?";
        $array = array($nombre, $apellidoPaterno, $apellidoMaterno, $correo, $celular, $id);
        return $this->save($consulta, $array);
    }
}
