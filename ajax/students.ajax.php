<?php 

require_once "../controlador/ctrStudents.php";
require_once "../modelo/mdlStudents.php";

class AjaxStudents{

    // Propiedad para el ID del estudiante
    public $idStudent;

    // Método para editar estudiantes
    public function ajaxEditarStudents(){

        $item = "id";
        $valor = $this->idStudent;

        $respuesta = ctrStudents::ctrMostrarStudents($item, $valor);

        echo json_encode($respuesta);
    }

    // Propiedad para eliminar estudiante
    public $idEliminarStudent;

    public function ajaxEliminarStudents(){

        $respuesta = ctrStudents::ctrEliminarStudents($this->idEliminarStudent);

        echo $respuesta;
    }
}

// Editar estudiante
if(isset($_POST["student_id"])){

    $editar = new AjaxStudents();
    $editar->idStudent = $_POST["student_id"];
    $editar->ajaxEditarStudents();
}

// Eliminar estudiante
if(isset($_POST["idStudentE"])){

    $eliminar = new AjaxStudents();
    $eliminar->idEliminarStudent = $_POST["idStudentE"];
    $eliminar->ajaxEliminarStudents();
}
?>
