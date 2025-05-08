<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Citas</title>
    
</head>
<body>
    <h1>Listado de Citas</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <a href="/citas/create">Crear Nueva Cita</a>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Servicio</th>
                <th>Día</th>
                <th>Hora</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Suponiendo que `$citas` es una variable que contiene todas las citas -->
            @foreach($citas as $cita)
                <tr>
                    <td>{{ $cita->nombre }}</td>
                    <td>{{ $cita->apellido }}</td>
                    <td>{{ $cita->tipo_servicio }}</td>
                    <td>{{ $cita->dia }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>
                        <a href="/citas/{{ $cita->id }}/edit">Editar</a>
                        <form action="/citas/{{ $cita->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
