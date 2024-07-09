<?php


class ctrUsuarios {

    static public function ctrIngresoUsuarios() {

        if(isset($_POST["log_user"])) {

            $tabla = "usuarios";
            $item = "usuario";
            $valor = $_POST["log_user"];

            $respuesta = mdlUsuarios::mdlMostrarUsuariosl($tabla, $item, $valor);

            if ($respuesta && $respuesta["usuario"] == $_POST["log_user"] && password_verify($_POST["log_pass"], $respuesta["password"])) {

                $_SESSION["validarSession"] = "ok";
                $_SESSION["idBackend"] = $respuesta["id"];

                echo '<script>
                        window.location = "usuarios";
                      </script>';

            } else {

                echo "<div class='alert alert-danger mt-3 small'>ERROR: Usuario y/o contraseña incorrectos</div>";

            }

        }

    }

    static public function ctrEliminarUsuarios($id, $rutafoto) {
        if (file_exists("../" . $rutafoto)) {
            unlink("../" . $rutafoto);
        }
        $tabla = "usuarios";
        $respuesta = mdlUsuarios::mdlEliminarUsuarios($tabla, $id);
        return $respuesta;
    }

    static public function ctrMostrarUsuarios1($item, $valor) {
        $tabla = "usuarios";
        $respuesta = mdlUsuarios::MdlMostrarUsuarios1($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrMostrarUsuarios() {
        $tabla = "usuarios";
        $respuesta = mdlUsuarios::mdlMostrarUsuarios($tabla);
        return $respuesta;
    }

    static public function ctrEditarusuarios() {

        if(isset($_POST["idPerfilE"])) {

            if(isset($_FILES["subirImgusuariosE"]["tmp_name"]) && !empty($_FILES["subirImgusuariosE"]["tmp_name"])) {

                list($ancho, $alto) = getimagesize($_FILES["subirImgusuariosE"]["tmp_name"]);
                $nuevoAncho = 480;
                $nuevoAlto = 382;
                $directorio = "vistas/imagenes/usuarios";

                if(isset($_POST["fotoActualE"]) && file_exists($_POST["fotoActualE"])) {
                    unlink($_POST["fotoActualE"]);
                }

                if($_FILES["subirImgusuariosE"]["type"] == "image/jpeg") {

                    $aleatorio = mt_rand(100, 999);
                    $rutas = $directorio . "/" . $aleatorio . ".jpg";

                    $origen = imagecreatefromjpeg($_FILES["subirImgusuariosE"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);    
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $rutas);    

                } else if($_FILES["subirImgusuariosE"]["type"] == "image/png") {

                    $aleatorio = mt_rand(100, 999);
                    $rutas = $directorio . "/" . $aleatorio . ".png";

                    $origen = imagecreatefrompng($_FILES["subirImgusuariosE"]["tmp_name"]);                        
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $rutas);

                } else {
                    echo '<script>
                            swal({
                                type:"error",
                                title: "¡CORREGIR!",
                                text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){   
                                    history.back();
                                } 
                            });
                          </script>';
                    return;
                }

            } else {
                $rutas = $_POST["fotoActualE"];
            }

            if($_POST["pass_userE"] != "") {
                $password = password_hash($_POST["pass_userE"], PASSWORD_BCRYPT); 
            } else {
                $password = $_POST["pass_userActualE"];
            }

            $datos = array(
                "idE" => $_POST["idPerfilE"],
                "nom_usuarioE" => $_POST["nom_usuariosE"],
                "nom_userE" => $_POST["nom_userE"],
                "passE" => $password,
                "rol_userE" => $_POST["rol_userE"],
                "img" => $rutas
            );

            $tabla = "usuarios";

            $respuesta = mdlUsuarios::mdlEditarUsuarios($tabla, $datos);

            if($respuesta == "ok") {
                echo '<script>
                        swal({
                            type:"success",
                            title: "¡CORRECTO!",
                            text: "El usuario ha sido editado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){   
                                history.back();
                            } 
                        });
                      </script>';
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Edición fallida</div>";
            }

        }

    }

    static public function ctrGuardarusuarios() {

        if(isset($_POST["nom_usuarios"])) {

            if(isset($_FILES["subirImgusuarios"]["tmp_name"]) && !empty($_FILES["subirImgusuarios"]["tmp_name"])) {

                list($ancho, $alto) = getimagesize($_FILES["subirImgusuarios"]["tmp_name"]);
                $nuevoAncho = 480;
                $nuevoAlto = 382;
                $directorio = "vistas/imagenes/usuarios";

                if($_FILES["subirImgusuarios"]["type"] == "image/jpeg") {

                    $aleatorio = mt_rand(100, 999);
                    $ruta = $directorio . "/" . $aleatorio . ".jpg";

                    $origen = imagecreatefromjpeg($_FILES["subirImgusuarios"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);    
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $ruta);    

                } else if($_FILES["subirImgusuarios"]["type"] == "image/png") {

                    $aleatorio = mt_rand(100, 999);
                    $ruta = $directorio . "/" . $aleatorio . ".png";

                    $origen = imagecreatefrompng($_FILES["subirImgusuarios"]["tmp_name"]);                        
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $ruta);

                } else {
                    echo '<script>
                            swal({
                                type:"error",
                                title: "¡CORREGIR!",
                                text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){   
                                    history.back();
                                } 
                            });
                          </script>';
                    return;
                }

            } else {
                $ruta = "";
            }

            $encriptarPassword = password_hash($_POST["pass_user"], PASSWORD_BCRYPT);

            $datos = array(
                "nom_usuario" => $_POST["nom_usuarios"],
                "nom_user" => $_POST["nom_user"],
                "pass_user" => $encriptarPassword,
                "rol_user" => $_POST["rol_user"],
                "foto" => $ruta
            );

            $tabla = "usuarios";

            $respuesta = mdlUsuarios::mdlguardarUsuarios($tabla, $datos);

            if($respuesta == "ok") {
                echo '<script>
                        swal({
                            type:"success",
                            title: "¡CORRECTO!",
                            text: "El usuario ha sido creado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){   
                                history.back();
                            } 
                        });
                      </script>';
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Registro fallido</div>";
            }

        }
    
    }

}
?>
