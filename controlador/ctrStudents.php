<?php

class ctrStudents {

    // Método para mostrar un solo estudiante por algún criterio (ID, nombre, etc.)
    static public function ctrMostrarEstudiante($item, $valor) {
        $tabla = "students";
        $respuesta = mdlStudents::mdlMostrarEstudiante($tabla, $item, $valor);
        return $respuesta;
    }

    // Método para mostrar todos los estudiantes
    static public function ctrMostrarEstudiantes() {
        $tabla = "students";
        $respuesta = mdlStudents::mdlMostrarEstudiantes($tabla);
        return $respuesta;

       

    }

 

    // Método para guardar un nuevo estudiante
    static public function ctrGuardarEstudiante() {
        if (isset($_POST["nombre"])) {
            $datos = array(
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "nacimiento" => $_POST["nacimiento"],
                "genero" => $_POST["genero"],
                "grado" => $_POST["grado"]
            );
            
            $tabla = "students";
            $respuesta = mdlStudents::mdlGuardarEstudiante($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type:"success",
                        title: "¡CORRECTO!",
                        text: "El estudiante ha sido registrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){   
                            window.location = "students";
                        } 
                    });
                    </script>';
            } else {
                echo '<div class="alert alert-danger">Registro fallido</div>';
            }
        }
    }

    // Método para eliminar un estudiante
    static public function ctrEliminarEstudiante($id) {
        $tabla = "students";
        $respuesta = mdlStudents::mdlEliminarEstudiante($tabla, $id);
        return $respuesta;
    }

    // Método para editar los datos de un estudiante
    static public function ctrEditarEstudiante() {
        if (isset($_POST["student_id"])) {
            $datos = array(
                "student_id" => $_POST["student_id"],
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "nacimiento" => $_POST["nacimiento"],
                "genero" => $_POST["genero"],
                "grado" => $_POST["grado"]

            );

            $tabla = "students";
            $respuesta = mdlStudents::mdlEditarEstudiante($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type:"success",
                        title: "¡CORRECTO!",
                        text: "El estudiante ha sido editado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){   
                            window.location = "students";
                        } 
                    });
                    </script>';
            } else {
                echo '<div class="alert alert-danger">Edición fallida</div>';
            }
        }
    }
}
?>
