<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cita</title>
    <style>
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

        h1 {
            font-size: 48px;
            color: #e60000;
            margin-bottom: 30px;
            font-weight: bold;
        }

        form {
            background-color: #222;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

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

        .error-messages {
            color: #ff6666;
            margin-bottom: 20px;
            text-align: left;
        }

    </style>
</head>

<body>
    <h1>Crear Cita</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/citas') }}" method="POST">
        @csrf

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required pattern="^[A-Za-záéíóúÁÉÍÓÚÑñ\s]+$" value="{{ old('nombre') }}"><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required pattern="^[A-Za-záéíóúÁÉÍÓÚÑñ\s]+$" value="{{ old('apellido') }}"><br>

        <label for="tipo_documento">Tipo de Documento:</label>
        <select id="tipo_documento" name="tipo_documento" required>
            <option value="cc" {{ old('tipo_documento') == 'cc' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
            <option value="ti" {{ old('tipo_documento') == 'ti' ? 'selected' : '' }}>Tarjeta de Identidad</option>
            <option value="cxe" {{ old('tipo_documento') == 'cxe' ? 'selected' : '' }}>Cédula de Extranjería</option>
            <option value="pasaporte" {{ old('tipo_documento') == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
        </select><br>

        <label for="numero_documento">Número de Documento:</label>
        <input type="number" id="numero_documento" name="numero_documento" required value="{{ old('numero_documento') }}"><br>

        <label for="tipo_servicio">Tipo de Servicio:</label>
        <select id="tipo_servicio" name="tipo_servicio" required>
            <option value="cambio de aceite" {{ old('tipo_servicio') == 'cambio de aceite' ? 'selected' : '' }}>Cambio de Aceite</option>
            <option value="revision general" {{ old('tipo_servicio') == 'revision general' ? 'selected' : '' }}>Revisión General</option>
            <option value="mantenimiento general" {{ old('tipo_servicio') == 'mantenimiento general' ? 'selected' : '' }}>Mantenimiento General</option>
        </select><br>

        <label for="dia">Día:</label>
        <input type="date" id="dia" name="dia" required value="{{ old('dia') }}"><br>

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" min="08:00" max="18:00" required value="{{ old('hora') }}"><br>

        <button type="submit">Crear Cita</button>
    </form>

    <br>

    <a href="{{ url('/citas') }}">
        <button>Volver</button>
    </a>

</body>
</html>
