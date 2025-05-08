<h2>Crear Cita</h2>
<form action="index.php?controlador=cita&accion=crear" method="POST">
    <label>Fecha:</label>
    <input type="date" name="fecha" required>
    
    <label>Hora:</label>
    <input type="time" name="hora" required>
    
    <label>Estado de la Cita:</label>
    <input type="number" name="estadoCita" required>
    
    <label>Usuario:</label>
    <input type="number" name="usuario" required>
    
    <input type="submit" value="Crear Cita">
</form>
