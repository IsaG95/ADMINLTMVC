import numpy as np
import tensorflow as tf
import json

# Leer los datos del archivo JSON generado por PHP
with open('datos_medidas.json', 'r') as f:
    data = json.load(f)

# Convertir los datos a un formato adecuado para el modelo de IA
datos_nutricion = np.array([[d['peso'], d['altura'], d['bmi']] for d in data])

# Definir el modelo de IA
capa_entrada = tf.keras.layers.Input(shape=(3,))  # 3 entradas: peso, altura, bmi
capa_oculta = tf.keras.layers.Dense(units=10, activation='relu')(capa_entrada)
capa_salida = tf.keras.layers.Dense(units=1, activation='sigmoid')(capa_oculta)

modelo = tf.keras.Model(inputs=capa_entrada, outputs=capa_salida)
modelo.compile(optimizer=tf.keras.optimizers.Adam(learning_rate=0.01), loss='mean_squared_error')

# Usar datos de ejemplo para riesgo de salud
riesgo_salud = np.random.rand(len(datos_nutricion))  # Placeholder

# Entrenar el modelo (opcional)
modelo.fit(datos_nutricion, riesgo_salud, epochs=500, verbose=False)

# Realizar predicciones
predicciones = modelo.predict(datos_nutricion)

# Crear un array para devolver las predicciones junto con los student_id
resultados = []
for i, d in enumerate(data):
    resultados.append({
        'student_id': d['student_id'],
        'riesgo': float(predicciones[i][0])
    })

# Devolver las predicciones en formato JSON
print(json.dumps(resultados))
