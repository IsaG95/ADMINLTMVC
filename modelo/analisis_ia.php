<?php
require_once "conexion.php";
require_once "mdlMeasurements.php";

$tabla = "measurements";
$mediciones = mdlMeasurements::mdlMostrarMediciones($tabla);

// Verificar si $mediciones tiene datos antes de iterar
if (!empty($mediciones) && is_array($mediciones)) {
    $data = [];

    foreach ($mediciones as $medicion) {
        // Extraer los datos de cada medición
        $peso = $medicion["peso"];
        $altura = $medicion["altura"];
        $bmi = $medicion["bmi"];

        // Agregar los datos a la lista para el análisis de IA
        $data[] = [
            "peso" => $peso,
            "altura" => $altura,
            "bmi" => $bmi
        ];
    }

    // Guardar los datos en un archivo JSON temporal para ser procesados por el script de Python
    file_put_contents('datos_medidas.json', json_encode($data));

    // Ejecutar el script de Python y obtener el resultado
    $output = shell_exec("python analisis_ia.py");

    // Decodificar el resultado JSON devuelto por Python
    $predicciones = json_decode($output, true);

    if ($predicciones && is_array($predicciones)) {
        foreach ($predicciones as $index => $prediccion) {
            $riesgo = $prediccion['riesgo'];
            $peso = $data[$index]['peso'];
            $altura = $data[$index]['altura'];
            $bmi = $data[$index]['bmi'];

            // Preparar la inserción de datos en la tabla `analisis_data`
            $stmt = Conexion::conectar()->prepare("INSERT INTO analisis_data (peso, altura, bmi, riesgo) VALUES (:peso, :altura, :bmi, :riesgo)");
            $stmt->bindParam(":peso", $peso);
            $stmt->bindParam(":altura", $altura);
            $stmt->bindParam(":bmi", $bmi);
            $stmt->bindParam(":riesgo", $riesgo);

            if (!$stmt->execute()) {
                echo "Error al insertar los datos en la tabla analisis_data.";
                return; // Detener si hay un fallo en la inserción
            }
        }
        echo "Análisis completado y datos insertados correctamente.";
    } else {
        echo "Error al procesar las predicciones de IA.";
    }
} else {
    echo "No se encontraron datos para analizar en la tabla measurements.";
}
