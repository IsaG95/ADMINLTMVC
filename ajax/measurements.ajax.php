<?php 

require_once "../controlador/ctrMeasurements.php";
require_once "../modelo/mdlMeasurements.php";

class AjaxMeasurements {

    public $idMeasurement;

    public function ajaxEditarMeasurement() {
        $item = "id";
        $valor = $this->idMeasurement;

        $respuesta = ctrMeasurements::ctrMostrarMediciones($item, $valor);

        echo json_encode($respuesta);
    }

    public $idEliminarMeasurement;

    public function ajaxEliminarMeasurement() {
        $respuesta = ctrMeasurements::ctrEliminarMediciones($this->idEliminarMeasurement);

        echo $respuesta;
    }
}

// Editar medición
if (isset($_POST["idMeasurement"])) {
    $editar = new AjaxMeasurements();
    $editar->idMeasurement = $_POST["idMeasurement"];
    $editar->ajaxEditarMeasurement();
}

// Eliminar medición
if (isset($_POST["idMeasurementE"])) {
    $eliminar = new AjaxMeasurements();
    $eliminar->idEliminarMeasurement = $_POST["idMeasurementE"];
    $eliminar->ajaxEliminarMeasurement();
}

?>
