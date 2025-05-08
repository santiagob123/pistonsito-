<?php
require_once "../Modelo/conexion.php";
require_once "../Modelo/Usuario.php";

$conexion = Conectarse();
$usuario = new Usuario($conexion);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'];

    if ($accion === 'registrar') {
        // Recoger los datos del formulario
        $nombre = $_POST['userName'];
        $email = $_POST['userEmail'];
        $password = $_POST['userPassword'];
        $tipoDocumento = $_POST['tipoDocumento'];
        $numeroDocumento = $_POST['numeroDocumento'];
        $apellido = $_POST['userApellido'];
        $telefono = $_POST['userTelefono'];
        $direccion = $_POST['userDireccion'];

        // 1. Insertar la contraseña en la tabla Usuario_password
        $insertPasswordQuery = "INSERT INTO Usuario_password (password) VALUES (?)";
        $stmt = $conexion->prepare($insertPasswordQuery);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Encriptar la contraseña
        $stmt->bind_param('s', $hashedPassword);
        $stmt->execute();

        // Obtener el ID de la contraseña insertada
        $idPassword = $conexion->insert_id;

        // 2. Insertar los datos del usuario en la tabla Usuario, incluyendo el Id_Usupass
        $insertUserQuery = "INSERT INTO Usuario (Usu_Tipo_Documento, Usu_Numero_Documento, Usu_Nombre, Usu_Apellido, Usu_Telefono, Usu_Direccion, Usu_Email, Id_Usupass, Rol_Id_Rol) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($insertUserQuery);
        $rolId = 2; // Asignar el rol predeterminado
        $stmt->bind_param('ssssssssi', $tipoDocumento, $numeroDocumento, $nombre, $apellido, $telefono, $direccion, $email, $idPassword, $rolId);
        $registrado = $stmt->execute();

        // 3. Redirigir en función de si se registró correctamente o no
        if ($registrado) {
            header('Location: ../Vista/ini_de_sesion.php?registro=exito');
        } else {
            header('Location: ../Vista/ini_de_sesion.php?registro=error');
        }
    }

    if ($accion === 'login') {
        $email = $_POST['userEmail'];
        $password = $_POST['userPassword'];

        $userId = $usuario->autenticarUsuario($email, $password);

        if ($userId) {
            // Usuario autenticado
            header('Location: ../Vista/usuario_bienvenida.php');
        } else {
            // Fallo en la autenticación
            header('Location: ../Vista/ini_de_sesion.php?login=error');
        }
    }
}

?>