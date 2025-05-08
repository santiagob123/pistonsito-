<?php
class Usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario($tipoDocumento, $numeroDocumento, $nombre, $apellido, $telefono, $direccion, $email, $password, $rol) {
        // Hashear la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL
        $sql = "INSERT INTO Usuario (Usu_Tipo_Documento, Usu_Numero_Documento, Usu_Nombre, Usu_Apellido, Usu_Telefono, Usu_Direccion, Usu_Email, Id_Usupass, Rol_Id_Rol) VALUES (?, ?, ?, ?, ?, ?, ?, (SELECT Id_Usupass FROM Usuario_password WHERE password = ? LIMIT 2), ?)";
        $stmt = $this->conexion->prepare($sql);

        // Ejecutar la consulta
        if ($stmt) {
            $stmt->bind_param('ssssssssi', $tipoDocumento, $numeroDocumento, $nombre, $apellido, $telefono, $direccion, $email, $hashedPassword, $rol);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    public function autenticarUsuario($email, $password)
    {
        // Consulta SQL que busca el usuario por su correo y se une con la tabla Usuario_password
        $query = "SELECT u.Id_Usu, up.password 
              FROM Usuario u
              INNER JOIN Usuario_password up ON u.Id_Usupass = up.Id_Usupass
              WHERE u.Usu_Email = ?";

        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si el usuario existe
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                return $user['Id_Usu']; // Retornar el ID del usuario si la contraseña es correcta
            } else {
                return false; // Contraseña incorrecta
            }
        } else {
            return false; // No se encontró el usuario
        }
    }

        }  

?>
