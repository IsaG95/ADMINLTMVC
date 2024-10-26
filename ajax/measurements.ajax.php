<?php 

require_once "../controlador/ctrMeasurements.php";
require_once "../modelo/mdlMeasurements.php";

class AjaxMeasurements {

    public $measurementid;

    public function ajaxEditarMeasurement() {
        $item = "measurement_id";
        $valor = $this->measurementid;

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
if (isset($_POST["measurement_id"])) {
    $editar = new AjaxMeasurements();
    $editar->measurementid = $_POST["measurement_id"];
    $editar->ajaxEditarMeasurement();
}

// Eliminar medición
if (isset($_POST["idMeasurementE"])) {
    $eliminar = new AjaxMeasurements();
    $eliminar->idEliminarMeasurement = $_POST["idMeasurementE"];
    $eliminar->ajaxEliminarMeasurement();
}
?>
