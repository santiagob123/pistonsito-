<?php
require_once "../Modelo/conexion.php";
require_once "../Modelo/Usuario.php";

$conexion = Conectarse();

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

        // 2. Insertar los datos del usuario en la tabla Usuario, asignando el rol 2 (usuario)
        $insertUserQuery = "INSERT INTO Usuario (Usu_Tipo_Documento, Usu_Numero_Documento, Usu_Nombre, Usu_Apellido, Usu_Telefono, Usu_Direccion, Usu_Email, Id_Usupass, Rol_Id_Rol) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($insertUserQuery);
        $rolId = 2; // Rol de usuario
        $stmt->bind_param('ssssssssi', $tipoDocumento, $numeroDocumento, $nombre, $apellido, $telefono, $direccion, $email, $idPassword, $rolId);
        $registrado = $stmt->execute();

        // Responder con JSON
        if ($registrado) {
            echo json_encode(["success" => true, "message" => "Registro exitoso"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al registrar usuario"]);
        }
        exit;
    }
}
?>