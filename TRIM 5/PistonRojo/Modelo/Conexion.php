<?php
function Conectarse()
{
    // Intentar conectar a la base de datos
    $Conexion = mysqli_connect("localhost", "root", "", "piston");

    // Verificar la conexión
    if (!$Conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $Conexion;
}
?>
