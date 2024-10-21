<?php

class ctrMeasurements {

    static public function ctrMostrarMediciones() {
        $tabla = "measurements";
        $respuesta = mdlMeasurements::mdlMostrarMediciones($tabla);
        return $respuesta;
    }

    static public function ctrGuardarMediciones() {
        if(isset($_POST["peso"])) {

            $datos = array(
                "student_id" => $_POST["student_id"],
                "peso" => $_POST["peso"],
                "altura" => $_POST["altura"],
                "fecha" => $_POST["fecha"],
                "bmi" => $_POST["bmi"]
            );

            $tabla = "measurements";
            $respuesta = mdlMeasurements::mdlGuardarMediciones($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        swal({
                            type: "success",
                            title: "¡CORRECTO!",
                            text: "La medición ha sido creada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "measurements";
                            }
                        });
                      </script>';
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Registro fallido</div>";
            }
        }
    }

    static public function ctrEditarMediciones() {
        if (isset($_POST["idMedicion"])) {

            $datos = array(
                "id" => $_POST["idMedicion"],
                "student_id" => $_POST["student_id"],
                "peso" => $_POST["peso"],
                "altura" => $_POST["altura"],
                "bmi" => $_POST["bmi"],
                "fecha" => $_POST["fecha"]
            );

            $tabla = "measurements";
            $respuesta = mdlMeasurements::mdlEditarMediciones($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        swal({
                            type: "success",
                            title: "¡CORRECTO!",
                            text: "La medición ha sido editada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "measurements";
                            }
                        });
                      </script>';
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Edición fallida</div>";
            }
        }
    }

    static public function ctrEliminarMediciones($id) {
        $tabla = "measurements";
        $respuesta = mdlMeasurements::mdlEliminarMediciones($tabla, $id);

        return $respuesta;
    }

}

