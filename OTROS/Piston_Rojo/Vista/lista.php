<h2>Lista de Citas</h2>
<a href="index.php?controlador=cita&accion=crear">Crear nueva cita</a>
<table>
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Estado</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($citas as $cita): ?>
        <tr>
            <td><?= $cita->Id_Citas ?></td>
            <td><?= $cita->Cit_Fecha ?></td>
            <td><?= $cita->Cit_Hora ?></td>
            <td><?= $cita->Id_estadoCita ?></td>
            <td><?= $cita->Usuario_Id_Usu ?></td>
            <td>
                <a href="index.php?controlador=cita&accion=editar&id=<?= $cita->Id_Citas ?>">Editar</a>
                <a href="index.php?controlador=cita&accion=eliminar&id=<?= $cita->Id_Citas ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
