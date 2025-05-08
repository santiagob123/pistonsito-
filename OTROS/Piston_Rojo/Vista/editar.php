<h2>Editar Cita</h2>
<form action="index.php?controlador=cita&accion=editar&id=<?= $cita->Id_Citas ?>" method="POST">
    <label>Fecha:</label>
    <input type="date" name="fecha" value="<?= $cita->Cit_Fecha ?>" required>
    
    <label>Hora:</label>
    <input type="time" name="hora" value="<?= $cita->Cit_Hora ?>" required>
    
    <label>Estado de la Cita:</label>
    <input type="number" name="estadoCita" value="<?= $cita->Id_estadoCita ?>" required>
    
    <label>Usuario:</label>
    <input type="number" name="usuario" value="<?= $cita->Usuario_Id_Usu ?>" required>
    
    <input type="submit" value="Actualizar Cita">
</form>
