<?php

require_once "conexion.php";

class mdlMeasurements {

    public static function mdlMostrarMediciones($tabla) {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            $result = $stmt->fetchAll();
            if (!$result) {
                echo "No se encontraron datos en la tabla $tabla.";
            }
            return $result;
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return null;
        }
    }

    static public function mdlGuardarMediciones($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (student_id, peso, altura, bmi, fecha) VALUES (:student_id, :peso, :altura, :bmi, :fecha)");
        $stmt->bindParam(":student_id", $datos["student_id"], PDO::PARAM_INT);
        $stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
        $stmt->bindParam(":altura", $datos["altura"], PDO::PARAM_STR);
        $stmt->bindParam(":bmi", $datos["bmi"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    static public function mdlEditarMediciones($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET student_id = :student_id, peso = :peso, altura = :altura, bmi = :bmi, fecha = :fecha WHERE measurement_id = :measurement_id");
        $stmt->bindParam(":measurement_id", $datos["measurement_id"], PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $datos["student_id"], PDO::PARAM_INT);
        $stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
        $stmt->bindParam(":altura", $datos["altura"], PDO::PARAM_STR);
        $stmt->bindParam(":bmi", $datos["bmi"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    static public function mdlEliminarMediciones($tabla, $id) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE measurement_id = :measurement_id");
        $stmt->bindParam(":measurement_id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
?>
