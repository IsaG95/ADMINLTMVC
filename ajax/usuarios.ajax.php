<?php 

require_once "../controlador/usuarios.controlador.php";
require_once "../modelo/usuarios.modelo.php";




class AjaxUsuarios{




    public $idUsuario;

    public function ajaxEditarUsuarios(){

        $item = "id";
        $valor = $this->idUsuario;

        $respuesta = ctrUsuarios::ctrMostrarUsuarios1($item,$valor);

        

        echo json_encode($respuesta);


    }



    public $idEliminar;
    public $rutaFoto;

     public function ajaxEliminarUsuarios(){


        $respuesta = ctrUsuarios::ctrEliminarUsuarios($this->idEliminar , $this->rutaFoto);


       echo $respuesta;
     

    }

    public $usuario;
    public $password;

    public $nombre;

    public $foto;

    public $rol;

    public function ajaxCrearUsuarios(){
        $datos = array(
            "usuario" => $this->usuario,
            "password" => $this->password,
            "nombre" => $this->nombre,
            "foto" => $this->foto,
            "rol" => $this->rol
        );
    
        $respuesta = ctrUsuarios::ctrCrearUsuarios($datos);
        echo json_encode($respuesta);
    }



}







//editar usuario

if(isset($_POST["idUsuario"])){

$editar = new AjaxUsuarios();
$editar->idUsuario = $_POST["idUsuario"];
$editar->ajaxEditarUsuarios();


}




//eliminar usuario

if(isset($_POST["idUsuarioE"])){

$eliminar = new AjaxUsuarios();
$eliminar->idEliminar = $_POST["idUsuarioE"];
$eliminar->rutaFoto = $_POST["rutaFoto"];
$eliminar->ajaxEliminarUsuarios();


}

// Crear usuario
if(isset($_POST["nuevoUsuario"])){
    $crear = new AjaxUsuarios();
    $crear->usuario = $_POST["usuario"];
    $crear->password = $_POST["password"];
    $crear->nombre = $_POST["nombre"];
    $crear->foto = $_POST["foto"];
    $crear->rol = $_POST["rol"];
    $crear->ajaxCrearUsuarios();
}


?>