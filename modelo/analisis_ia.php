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
        $student_id = $medicion["student_id"];

        // Agregar los datos a la lista para el análisis de IA
        $data[] = [
            "peso" => $peso,
            "altura" => $altura,
            "bmi" => $bmi,
            "student_id" => $student_id
        ];
    }

    // Guardar los datos en un archivo JSON temporal para ser procesados por el script de Python
    file_put_contents('datos_medidas.json', json_encode($data));

    // Ejecutar el script de Python y obtener el resultado
    $output = shell_exec("python analisis_ia.py");

// Limpiar la salida
$output = preg_replace('/\x1B\[[0-9;]*[mK]/', '', $output); // Eliminar códigos de formato ANSI

// Encontrar la posición del primer '[' en la salida
$pos = strpos($output, '[');
if ($pos !== false) {
    // Extraer solo la parte que contiene el JSON
    $jsonOutput = substr($output, $pos); // Obtener desde el primer '[' hasta el final
} else {
    echo "No se encontró la parte JSON en la salida.";
    return;
}

// Decodificar el resultado JSON devuelto por Python
$predicciones = json_decode(trim($jsonOutput), true);

// Imprimir la salida limpia para depuración
var_dump($jsonOutput); // Verificar que el JSON esté limpio


    // Verificar errores en la decodificación
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error al decodificar JSON: " . json_last_error_msg();
        return; // Detener si hay un fallo en la decodificación
    }


    // Procesar las predicciones si no hay errores
    if ($predicciones && is_array($predicciones)) {
        foreach ($predicciones as $index => $prediccion) {
            $riesgo = $prediccion['riesgo'];
            $student_id = $prediccion['student_id'];

            // Preparar la inserción de datos en la tabla `analisis_data`
            $stmt = Conexion::conectar()->prepare("INSERT INTO analisis_data (student_id, riesgo) VALUES (:student_id, :riesgo)");
            $stmt->bindParam(":student_id", $student_id);
            $stmt->bindParam(":riesgo", $riesgo);

            if (!$stmt->execute()) {
                echo "Error al insertar los datos en la tabla analisis_data: " . implode(", ", $stmt->errorInfo());
                return; // Detener si hay un fallo en la inserción
            }
        }
        echo "Análisis completado y datos insertados correctamente.";
    } 
    
        else {
        echo "Error al procesar las predicciones de IA.";
    }
}

    else {
    echo "No se encontraron datos para analizar en la tabla measurements.";
}
