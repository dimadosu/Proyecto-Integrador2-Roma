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
        $consulta = "SELECT U.id, U.nombres, U.apellido_paterno, U.apellido_materno, 
		                U.correo, U.numero_celular, R.nombre AS rol 
                        FROM usuarios AS U , roles AS R
                    WHERE U.id_rol = R.id";
        return $this->selectAll($consulta);
    }

    public function getRoles(){
        $consulta = "SELECT * from roles";
        return $this->selectAll($consulta);
    }

    public function registrar(
        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $celular,
        $correo,
        $clave,
        $rol
    ) {

        $consulta = "INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, numero_celular, correo, clave, id_rol) 
                    VALUES (?,?,?,?,?,?,?)";
        $array = array(
            $nombre,
            $apellidoPaterno,
            $apellidoMaterno,
            $celular,
            $correo,
            $clave,
            $rol
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
        $consulta = "SELECT U.id, U.nombres, U.apellido_paterno, U.apellido_materno, 
		                U.correo, U.numero_celular, U.id_rol 
                        FROM usuarios AS U 
                        INNER JOIN roles AS R ON U.id_rol = R.id AND U.id = '$idUser'";
        return $this->select($consulta);
    }

    public function modificar(
        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $celular,
        $correo,
        $rol,
        $id
    ) {
        $consulta = "UPDATE usuarios SET nombres=?, apellido_paterno=?, apellido_materno=?, correo=?, numero_celular=?, id_rol=? WHERE id=?";
        $array = array($nombre, $apellidoPaterno, $apellidoMaterno, $correo, $celular, $rol,$id);
        return $this->save($consulta, $array);
    }
}
