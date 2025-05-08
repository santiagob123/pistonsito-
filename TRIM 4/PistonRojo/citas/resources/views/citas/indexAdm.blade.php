<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Citas</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            background: linear-gradient(135deg, #1e1e1e, #2a2a2a);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            font-size: 36px;
            color: #ff5252;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Botón para crear una cita */
        .create-btn-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .create-btn {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #ff5252;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(255, 82, 82, 0.3);
        }

        .create-btn:hover {
            background-color: #e04848;
            box-shadow: 0 6px 15px rgba(255, 82, 82, 0.5);
        }

        /* Estilos de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #1e1e1e;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #333;
            font-size: 14px;
        }

        table th {
            background-color: #ff5252;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        table td {
            background-color: #2a2a2a;
            color: #e0e0e0;
        }

        table tr:hover {
            background-color: #3a3a3a;
        }

        /* Botones dentro de la tabla */
        .edit-btn, .delete-btn {
            padding: 8px 16px;
            font-size: 14px;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background-color: #4caf50;
        }

        .edit-btn:hover {
            background-color: #43a047;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }

        /* Diseño responsivo */
        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            .create-btn {
                padding: 10px 20px;
                font-size: 14px;
            }

            table th, table td {
                padding: 10px;
                font-size: 12px;
            }
        }

    </style>
     
</head>
<body>
    <div class="container">
        <h1>Administrar Citas</h1>

        <!-- Botón para crear una nueva cita -->
        <div class="create-btn-container">
            <a href="{{ url('/citas/createAdmin') }}">
                <button class="create-btn">Crear Cita</button>
            </a>
        </div>

        <!-- Tabla de citas existentes -->
        <table id="citas-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo de Documento</th>
                    <th>Número de Documento</th>
                    <th>Tipo de Servicio</th>
                    <th>Día</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                <tr id="cita-{{ $cita->id }}">
                    <td>{{ $cita->nombre }}</td>
                    <td>{{ $cita->apellido }}</td>
                    <td>{{ $cita->tipo_documento }}</td>
                    <td>{{ $cita->numero_documento }}</td>
                    <td>{{ $cita->tipo_servicio }}</td>
                    <td>{{ $cita->dia }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>
                        <a href="{{ url('/citas/' . $cita->id . '/edit') }}">
                            <button class="edit-btn">Editar</button>
                        </a>
                        <br>
                        <br>
                        <button class="delete-btn" onclick="deleteCita('{{ $cita->id }}')">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function deleteCita(citaId) {
            if (confirm("¿Estás seguro de que deseas eliminar esta cita?")) {
                fetch(`/admin/${citaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    if (response.ok) {
                        document.querySelector(`button[onclick="deleteCita('${citaId}')"]`).closest('tr').remove();
                        alert("Cita eliminada correctamente.");
                    } else {
                        alert("Error al eliminar la cita.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Error de conexión.");
                });
            }
        }
    </script>
    <a href="http://localhost/PistonRojo/Vista/indexjv.php">
        <button>Volver</button>
    </a>
</body>
</html>