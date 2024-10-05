<?php 

include "controlador/plantilla.controlador.php";
include "controlador/usuarios.controlador.php";
include "controlador/roles.controlador.php";
include "controlador/ctrMeasurements.php";
include "controlador/ctrStudents.php";

include "modelo/usuarios.modelo.php";
include "modelo/roles.modelo.php";
include "modelo/mdlMeasurements.php";
include "modelo/mdlStudents.php";






$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();






?>