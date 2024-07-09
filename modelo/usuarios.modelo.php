<?php

require_once "conexion.php";

class mdlUsuarios {

    static public function mdlMostrarUsuariosl($tabla, $item, $valor) {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            var_dump($stmt);
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
            var_dump($stmt);  
        }
        
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEliminarUsuarios($tabla, $id) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    static public function mdlEditarUsuarios($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario=:NOM_E, password=:PASSSER_E, nombre=:NOMUSER_E, foto=:IMG_E, rol=:ROL_E WHERE id=:IDE");
        $stmt->bindParam(":IDE", $datos["idE"], PDO::PARAM_INT);
        $stmt->bindParam(":NOM_E", $datos["nom_usuarioE"], PDO::PARAM_STR);
        $stmt->bindParam(":NOMUSER_E", $datos["nom_userE"], PDO::PARAM_STR);
        $stmt->bindParam(":PASSSER_E", $datos["passE"], PDO::PARAM_STR);
        $stmt->bindParam(":ROL_E", $datos["rol_userE"], PDO::PARAM_STR);
        $stmt->bindParam(":IMG_E", $datos["img"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "error";
        }

        $stmt = null;
    }

    static public function MdlMostrarUsuarios1($tabla, $item, $valor) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch();
        $stmt = null;
        return $resultado;
    }

    static public function mdlMostrarUsuarios($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        return $resultado;
    }

    static public function mdlguardarUsuarios($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, password, nombre, foto, rol) VALUES (:USUARIO_u, :PASS_u, :NOMBRE_u, :FOTO_u, :ROL_u)");
        $stmt->bindParam(":NOMBRE_u", $datos["nom_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":USUARIO_u", $datos["nom_user"], PDO::PARAM_STR);
        $stmt->bindParam(":PASS_u", $datos["pass_user"], PDO::PARAM_STR);
        $stmt->bindParam(":ROL_u", $datos["rol_user"], PDO::PARAM_INT);
        $stmt->bindParam(":FOTO_u", $datos["foto"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "error";
        }

        $stmt = null;
    }
}
?>
