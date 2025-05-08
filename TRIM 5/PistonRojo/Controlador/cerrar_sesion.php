<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = [];

// Eliminar la cookie de sesión si existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000000000000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header('Location: ../index.php');
exit();
?>
