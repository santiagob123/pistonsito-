<?php
include_once '../Modelo/Conexion.php';
include_once '../Controlador/CitaController.php';

$citaController = new CitaController(); // Crear instancia de CitaController

// Lógica para determinar qué acción realizar (listar, crear, editar, etc.)
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';

switch ($accion) {
    case 'listar':
        listarCitas();
        break;
    case 'crear':
        crearCita();
        break;
    case 'editar':
        editarCita($_GET['id']);
        break;
    case 'guardar':
        $citaController->guardarCita($_POST); // Llamada correcta a la función
        break;
    default:
        listarCitas();
        break;
}

// Función para listar citas
function listarCitas() {
    global $citaController; // Para poder usar la instancia de CitaController

    $citas = $citaController->obtenerCitas();

    echo '<div class="container">';
    echo '<h1>Listado de Citas</h1>';
    echo '<div class="button-container">';
    echo '<a href="citas.php?accion=crear" class="btn btn-primary">Crear Nueva Cita</a>';
    echo '</div>';
    echo '<table>';
    echo '<tr><th>ID</th><th>Fecha</th><th>Hora</th><th>Estado</th><th>Acciones</th></tr>';
    
    foreach ($citas as $cita) {
        echo '<tr>';
        echo '<td>' . $cita['Id_Citas'] . '</td>';
        echo '<td>' . $cita['Cit_Fecha'] . '</td>';
        echo '<td>' . $cita['Cit_Hora'] . '</td>';
        echo '<td>' . obtenerEstadoCita($cita['Id_estadoCita']) . '</td>'; 
        echo '<td>';
        echo '<a href="citas.php?accion=editar&id=' . $cita['Id_Citas'] . '" class="btn btn-warning">Editar</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
}

// Función para obtener el estado de la cita
function obtenerEstadoCita($idEstado) {
    switch ($idEstado) {
        case 1:
            return 'Atendida';
        case 2:
            return 'Confirmada';
        case 3:
            return 'Rechazada';
        default:
            return 'Desconocido';
    }
}

// Función para crear una cita
function crearCita() {
    echo '<div class="container">';
    echo '<h1>Crear Nueva Cita</h1>';
    echo '<form action="citas.php?accion=guardar" method="POST">';
    echo '<label for="fecha">Fecha:</label>';
    echo '<input type="date" name="fecha" required>';
    echo '<label for="hora">Hora:</label>';
    echo '<input type="time" name="hora" required>';
    echo '<label for="estado">Estado:</label>';
    echo '<select name="estado" required>';
    echo '<option value="1">Atendida</option>';
    echo '<option value="2">Confirmada</option>';
    echo '<option value="3">Rechazada</option>';
    echo '</select>';
    echo '<button type="submit" class="btn btn-success">Guardar</button>';
    echo '<a href="citas.php" class="btn btn-secondary">Cancelar</a>';
    echo '</form>';
    echo '</div>';
}

// Función para editar una cita
function editarCita($id) {
    global $citaController;

    // Obtener información de la cita a editar
    $cita = $citaController->obtenerCitaPorId($id); // Debes implementar esta función

    echo '<div class="container">';
    echo '<h1>Editar Cita</h1>';
    echo '<form action="citas.php?accion=guardar" method="POST">';
    echo '<input type="hidden" name="id" value="' . $cita['Id_Citas'] . '">';
    echo '<label for="fecha">Fecha:</label>';
    echo '<input type="date" name="fecha" value="' . $cita['Cit_Fecha'] . '" required>';
    echo '<label for="hora">Hora:</label>';
    echo '<input type="time" name="hora" value="' . $cita['Cit_Hora'] . '" required>';
    echo '<label for="estado">Estado:</label>';
    echo '<select name="estado" required>';
    echo '<option value="1" ' . ($cita['Id_estadoCita'] == 1 ? 'selected' : '') . '>Atendida</option>';
    echo '<option value="2" ' . ($cita['Id_estadoCita'] == 2 ? 'selected' : '') . '>Confirmada</option>';
    echo '<option value="3" ' . ($cita['Id_estadoCita'] == 3 ? 'selected' : '') . '>Rechazada</option>';
    echo '</select>';
    echo '<button type="submit" class="btn btn-success">Actualizar</button>';
    echo '<a href="citas.php" class="btn btn-secondary">Cancelar</a>';
    echo '</form>';
    echo '</div>';
}
?>


<style>
/* Tu CSS aquí */
body {
    background-color: #961818;
    color: #ffffff; /* Texto blanco */
}

.container {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #000000;
    font-size: 26px;
    font-family: Arial, sans-serif;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid #e74c3c; /* Línea roja debajo del encabezado */
    padding-bottom: 5px;
}

h3 {
    color: #000000;
    font-size: 26px;
    font-family: Arial, sans-serif;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    padding-bottom: 5px;  
}

.btn-secondary {
    background-color: #000000; /* Fondo negro */
    color: #ffffff; /* Texto blanco */
    border: 1px solid #e74c3c; /* Borde rojo */
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-secondary:hover {
    background-color: #e74c3c; /* Fondo rojo al pasar el ratón */
    color: #ffffff; /* Texto blanco */
    border: 1px solid #e74c3c; /* Borde rojo */
}

.btn-primary {
    background-color: #000000; /* Fondo negro */
    color: #ffffff; /* Texto blanco */
    border: 1px solid #e74c3c; /* Borde rojo */
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-primary:hover {
    background-color: #e74c3c; 
}

.btn-warning {
    background-color: #fff8cb;
    color: #000000;
    border: 1px solid #e74c3c; 
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-warning:hover {
    background-color: #e67e22; 
}

.btn-success {
    background-color: #2ecc71; /* Verde para los botones de éxito */
    color: #ffffff; /* Texto blanco */
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-success:hover {
    background-color: #27ae60; /* Verde más oscuro al pasar el ratón */
}

.btn-danger {
    background-color: #000000; /* Fondo negro */
    color: #ffffff; /* Texto blanco */
    border: 1px solid #e74c3c; /* Borde rojo */
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-danger:hover {
    background-color: #e74c3c; /* Fondo rojo al pasar el ratón */
    color: #ffffff; /* Texto blanco */
    border: 1px solid #e74c3c; /* Borde rojo */
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px; /* Espaciado entre inputs */
    color: #000000; /* Color de texto negro */
    background-color: #ffffff; /* Fondo blanco */
}

.form-control:focus {
    border-color: #e74c3c; /* Borde rojo al hacer foco */
    outline: none; /* Elimina el borde predeterminado */
}

.button-container {
    margin-bottom: 20px; /* Espaciado entre botones */
}

/* Estilo para la tabla */
table {
    width: 100%;
    border-collapse: collapse;
    color: #000000; /* Texto negro para el contenido de la tabla */
}

th, td {
    border: 1px solid #ccc; /* Borde de celda */
    padding: 10px; /* Espaciado interno */
    text-align: left; /* Alinear texto a la izquierda */
}

th {
    background-color: #e74c3c; /* Fondo rojo para encabezados */
    color: #ffffff; /* Texto blanco para encabezados */
}
</style>