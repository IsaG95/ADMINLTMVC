import numpy as np
import tensorflow as tf
import json
import sys
import os

# Suprimir mensajes de TensorFlow (si es necesario)
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'  # Suprimir mensajes de advertencia y error

# Establecer la salida estándar a UTF-8
sys.stdout.reconfigure(encoding='utf-8')

# Leer los datos del archivo JSON generado por PHP
try:
    with open('datos_medidas.json', 'r') as f:
        data = json.load(f)
except FileNotFoundError:
    print("Error: No se pudo encontrar el archivo 'datos_medidas.json'.")
    exit(1)
except json.JSONDecodeError:
    print("Error: No se pudo decodificar el JSON.")
    exit(1)

# Comprobar si hay datos y validar los tipos
datos_nutricion = []
for d in data:
    try:
        peso = float(d['peso'])
        altura = float(d['altura'])
        bmi = float(d['bmi'])
        student_id = d.get('student_id', 'desconocido')  # Obtener student_id
        # Agregar los datos validados a la lista
        datos_nutricion.append([peso, altura, bmi])
    except (ValueError, KeyError) as e:
        print(f"Error procesando la entrada: {d}. Error: {e}")

# Convertir a un array de NumPy solo si hay datos válidos
if datos_nutricion:
    datos_nutricion = np.array(datos_nutricion)
else:
    print("Error: No hay datos válidos para procesar.")
    exit(1)

# Normalizar los datos
datos_nutricion = (datos_nutricion - np.mean(datos_nutricion, axis=0)) / np.std(datos_nutricion, axis=0)

# Definir el modelo de IA
capa_entrada = tf.keras.layers.Input(shape=(3,))  # 3 entradas: peso, altura, bmi
capa_oculta = tf.keras.layers.Dense(units=10, activation='relu')(capa_entrada)
capa_salida = tf.keras.layers.Dense(units=1, activation='sigmoid')(capa_oculta)

modelo = tf.keras.Model(inputs=capa_entrada, outputs=capa_salida)
modelo.compile(optimizer=tf.keras.optimizers.Adam(learning_rate=0.01), loss='mean_squared_error')

# Usar datos de ejemplo para riesgo de salud
riesgo_salud = np.random.rand(len(datos_nutricion))  # Placeholder, reemplaza esto con tus datos reales

# Entrenar el modelo (puedes aumentar las épocas si es necesario)
modelo.fit(datos_nutricion, riesgo_salud, epochs=1000, verbose=False)

# Realizar predicciones
predicciones = modelo.predict(datos_nutricion)

# Crear un array para devolver las predicciones junto con los student_id
resultados = []
for i, d in enumerate(data):
    resultados.append({
        'student_id': d.get('student_id', 'desconocido'),  # Usa 'desconocido' si no hay student_id
        'riesgo': float(predicciones[i][0])
    })

# Devolver las predicciones en formato JSON
try:
    print(json.dumps(resultados))
except Exception as e:
    print(f"Error al convertir resultados a JSON: {e}")
