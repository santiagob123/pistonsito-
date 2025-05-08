<?php
require_once '../Modelo/Usuario.php';
require_once '../Modelo/Conexion.php';

$conexion = Conectarse();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['userEmail'], $_POST['userPassword'])) {
        $userEmail = $_POST['userEmail'];
        $userPassword = $_POST['userPassword'];

        $usuario = new Usuario($conexion);
        $idUsuario = $usuario->autenticarUsuario($userEmail, $userPassword);

        if ($idUsuario) {
            $sql = "SELECT * FROM Usuario WHERE Id_Usu = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('i', $idUsuario);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $usuarioLogueado = $resultado->fetch_assoc();

            if ($usuarioLogueado) {
                session_start();
                $_SESSION['usuario'] = $usuarioLogueado;

                // Detectar si la solicitud es AJAX o no
                $isAjax = isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false;

                if ($usuarioLogueado['Rol_Id_Rol'] == 1) {
                    // Administrador
                    if ($isAjax) {
                        header('Content-Type: application/json');
                        echo json_encode([
                            "success" => true,
                            "message" => "Inicio de sesión exitoso",
                            "redirect" => "indexjv.php",
                            "role" => 1
                        ]);
                    } else {
                        header("Location: ../Vista/indexjv.php");
                        exit();
                    }
                } else {
                    // Usuario normal
                    if ($isAjax) {
                        header('Content-Type: application/json');
                        echo json_encode([
                            "success" => true,
                            "message" => "Inicio de sesión exitoso",
                            "redirect" => "indexUsu.php",
                            "role" => 2
                        ]);
                    } else {
                        header("Location: ../Vista/indexUsu.php");
                        exit();
                    }
                }
            } else {
                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => false, "message" => "No se pudo obtener información del usuario."]);
                } else {
                    header("Location: ../Vista/ini_de_sesion.php?error=info");
                    exit();
                }
            }
        } else {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => "Credenciales incorrectas."]);
            } else {
                header("Location: ../Vista/ini_de_sesion.php?error=credenciales");
                exit();
            }
        }
    } else {
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Por favor, complete todos los campos."]);
        } else {
            header("Location: ../Vista/ini_de_sesion.php?error=campos");
            exit();
        }
    }
}
?>