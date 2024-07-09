<?php 

require_once "../controlador/roles.controlador.php";
require_once "../modelo/roles.modelo.php";

class ajaxRoles{


  public $idRoles;

    public function ajaxEditarRoles(){

        $item = "id_roles";
        $valor = $this->idRoles;

        $respuesta = ctrRoles::ctrVerRoles($item,$valor);

    
        echo json_encode($respuesta);


    }



 public $idRolesE;

    public function ajaxEliminarRoles(){

       
        $valor = $this->idRolesE;

        $respuesta = ctrRoles::ctrEliminarRoles($valor);

    
        echo $respuesta;


    }





}



//editar usuario

if(isset($_POST["idRoles"])){

$editar = new ajaxRoles();
$editar->idRoles = $_POST["idRoles"];
$editar->ajaxEditarRoles();


}





//eliminar rol

if(isset($_POST["idRolE"])){

$eliminar = new ajaxRoles();
$eliminar->idRolesE = $_POST["idRolE"];
$eliminar->ajaxEliminarRoles();


}




?>