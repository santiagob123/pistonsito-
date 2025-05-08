<?php
require_once '../Modelo/Usuario.php';
require_once '../Modelo/Conexion.php';

$conexion = Conectarse(); // Asegúrate de que esta función esté bien definida en tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];

    $usuario = new Usuario($conexion);
    $idUsuario = $usuario->autenticarUsuario($userEmail, $userPassword);

    if ($idUsuario) {
        // Ahora obtenemos los datos completos del usuario, incluyendo el rol
        $sql = "SELECT * FROM Usuario WHERE Id_Usu = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuarioLogueado = $resultado->fetch_assoc();

        if ($usuarioLogueado) {
            if ($usuarioLogueado['Rol_Id_Rol'] == 1) { // Administrador
                header("Location: ../indexjv.html");
            } elseif ($usuarioLogueado['Rol_Id_Rol'] == 2) { // Cliente
                header("Location: ../Usuario1.html");
            }
            exit();
        }
    } else {
        echo "Credenciales incorrectas. Inténtelo de nuevo.";
    }
}
