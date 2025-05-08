<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cita</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1a1a1a;
            margin: 0;
            padding: 0;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        /* Títulos */
        h1 {
            font-size: 48px;
            color: #e60000;
            margin-bottom: 30px;
            font-weight: bold;
        }

        /* Formulario */
        form {
            background-color: #222;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        /* Etiquetas y entradas de formulario */
        label {
            font-size: 16px;
            color: #fff;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            text-align: left;
        }

        input, select {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #444;
            border-radius: 6px;
            background-color: #222;
            color: #fff;
            width: 100%;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #e60000;
            background-color: #333;
            outline: none;
        }

        /* Botón */
        button {
            padding: 15px 30px;
            font-size: 18px;
            color: #fff;
            background-color: #e60000;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #b50000;
        }

    </style>
    
</head>

<body>
    <h1>Crear Cita</h1>

    <form action="{{ url('/citas') }}" method="POST">
        @csrf

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br>

        <label for="tipo_documento">Tipo de Documento:</label>
        <select id="tipo_documento" name="tipo_documento" required>
            <option value="cc">Cédula de Ciudadanía</option>
            <option value="ti">Tarjeta de Identidad</option>
            <option value="cxe">Cédula de Extranjería</option>
            <option value="pasaporte">Pasaporte</option>
        </select><br>

        <label for="numero_documento">Número de Documento:</label>
        <input type="Number" id="numero_documento" name="numero_documento" required><br>

        <label for="tipo_servicio">Tipo de Servicio:</label>
        <select id="tipo_servicio" name="tipo_servicio" required>
            <option value="cambio de aceite">Cambio de Aceite</option>
            <option value="revision general">Revisión General</option>
            <option value="mantenimiento general">Mantenimiento General</option>
        </select><br>

        <label for="dia">Día:</label>
        <input type="date" id="dia" name="dia" required><br>

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" min="08:00" max="18:00" required><br>

        <button type="submit">Crear Cita</button>
        
    </form>
    <br>
    <a href="{{ url('http://127.0.0.1:8000/admin') }}">
    <button>Volver</button>
</a>

</body>
</html>
