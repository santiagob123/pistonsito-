<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #181818;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        /* Contenedor principal */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 40px;
            background-color: #222;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Títulos */
        h1 {
            text-align: center;
            font-size: 40px;
            color: #e60000;
            margin-bottom: 20px;
            font-weight: bold;
        }

        h3 {
            font-size: 24px;
            color: #fff;
            margin-bottom: 20px;
        }

        /* Detalles de la cita */
        .cita-details {
            background-color: #333;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 40px;
            transition: all 0.3s ease;
        }

        .cita-details:hover {
            background-color: #444;
            transform: scale(1.02);
        }

        .cita-details p {
            font-size: 16px;
            line-height: 1.8;
            margin: 12px 0;
        }

        .cita-details strong {
            color: #e60000;
        }

        /* Formularios de entrada */
        form {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-top: 20px;
        }

        label {
            font-size: 16px;
            color: #fff;
            font-weight: bold;
        }

        input, select {
            padding: 15px;
            font-size: 16px;
            border: 1px solid #444;
            border-radius: 8px;
            background-color: #222;
            color: #fff;
            width: 100%;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #e60000;
            background-color: #333;
            outline: none;
        }

        /* Botones */
        button {
            padding: 15px 30px;
            font-size: 18px;
            color: #fff;
            background-color: #e60000;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        button:hover {
            background-color: #b50000;
        }

        /* Botón de eliminar */
        .delete-btn {
            background-color: #dc3545;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        /* Animación de carga */
        .loading {
            display: none;
            text-align: center;
            font-size: 18px;
            color: #e60000;
            margin-top: 20px;
        }

        .loading.show {
            display: block;
        }

        /* Iconos */
        .icon {
            margin-right: 10px;
        }

    </style>
    
</head>
<body>
    <div class="container">
        <h1>CITAS</h1>

        <!-- Mostrar los detalles de la cita -->
        <div class="cita-details">
            <h3><strong>Detalles de la Cita:</strong></h3>
            <p><strong>Nombre:</strong> {{ $cita->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $cita->apellido }}</p>
            <p><strong>Tipo de Documento:</strong> {{ $cita->tipo_documento }}</p>
            <p><strong>Número de Documento:</strong> {{ $cita->numero_documento }}</p>
            <p><strong>Tipo de Servicio:</strong> {{ $cita->tipo_servicio }}</p>
            <p><strong>Día:</strong> {{ $cita->dia }}</p>
            <p><strong>Hora:</strong> {{ $cita->hora }}</p>
        </div>

        <!-- Formulario para editar la cita -->
        <h3><strong>Editar Cita</strong></h3>
        <form action="{{ url('/citas/' . $cita->id) }}" method="POST" onsubmit="return confirmUpdate()">
            @csrf
            @method('PUT')

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $cita->nombre }}" required><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ $cita->apellido }}" required><br>

            <label for="tipo_documento">Tipo de Documento:</label>
            <select id="tipo_documento" name="tipo_documento" required>
                <option value="cc" {{ $cita->tipo_documento == 'cc' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                <option value="ti" {{ $cita->tipo_documento == 'ti' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                <option value="cxe" {{ $cita->tipo_documento == 'cxe' ? 'selected' : '' }}>Cédula de Extranjería</option>
                <option value="pasaporte" {{ $cita->tipo_documento == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
            </select><br>

            <label for="numero_documento">Número de Documento:</label>
            <input type="text" id="numero_documento" name="numero_documento" 
       value="{{ $cita->numero_documento }}" 
       required 
       pattern="^\d{10}$" 
       maxlength="10"
       oninvalid="this.setCustomValidity('Debe contener exactamente 10 dígitos numéricos')" 
       oninput="this.setCustomValidity('')">
<br>
<small id="error-numero" style="color: red;"></small>

<small id="error-numero" style="color: red;"></small>


            <label for="tipo_servicio">Tipo de Servicio:</label>
            <select id="tipo_servicio" name="tipo_servicio" required>
                <option value="cambio de aceite" {{ $cita->tipo_servicio == 'cambio de aceite' ? 'selected' : '' }}>Cambio de Aceite</option>
                <option value="revision general" {{ $cita->tipo_servicio == 'revision general' ? 'selected' : '' }}>Revisión General</option>
                <option value="mantenimiento general" {{ $cita->tipo_servicio == 'mantenimiento general' ? 'selected' : '' }}>Mantenimiento General</option>
            </select><br>

            <label for="dia">Día:</label>
            <input type="date" id="dia" name="dia" value="{{ $cita->dia }}" required><br>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" value="{{ $cita->hora }}" min="08:00" max="18:00" required><br>

            <button type="submit">
                <span class="icon"></span>Actualizar Cita
            </button>
        </form>

        <!-- Formulario para eliminar la cita -->
        <form action="{{ url('/citas/' . $cita->id) }}" method="POST" class="delete-form" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">
                <span class="icon"></span>Eliminar Cita
            </button>
        </form>

        <!-- Animación de carga -->
        <div class="loading" id="loading">Cargando...</div>
    </div>

    <script>
        function showLoading() {
            document.getElementById('loading').classList.add('show');
        }

        function confirmUpdate() {
            return confirm("¿Estás seguro de que deseas actualizar esta cita?");
        }

        function confirmDelete() {
            return confirm("¿Estás seguro de que deseas eliminar esta cita?");
        }
    </script>
</body>
</html>
