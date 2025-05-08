<?php
session_start();

// Si no hay sesión iniciada en PHP, puedes redirigir manualmente si lo deseas
 if (!isset($_SESSION['usuario'])) {
     header("Location: ini_de_sesion.php");
     exit();
 }

if (isset($_SESSION['usuario'])) {
    echo "<script>window.skipFirebaseCheck = true;</script>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piston Rojo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="../css/estilosjv.css">
    <link rel="icon" type="image/png" href="../imagenes/Logo.png">
    
    <script type="module">
        // Configuración de Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyBCerg-Tzv85bHEbxsgNScGoJ65w2W7tmM",
            authDomain: "pistonrojo-d4bfb.firebaseapp.com",
            projectId: "pistonrojo-d4bfb",
            storageBucket: "pistonrojo-d4bfb.appspot.com",
            messagingSenderId: "709609617298",
            appId: "1:709609617298:web:63676148d5ebd3c8e5334b",
            measurementId: "G-PNRT5H6ZT0"
        };

        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
        import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-auth.js";

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        // Solo verificar con Firebase si no hay sesión PHP activa
        if (!window.skipFirebaseCheck) {
            onAuthStateChanged(auth, user => {
                if (!user) {
                    window.location.href = "../vista/ini_de_sesion.php";
                } else {
                    console.log("Usuario autenticado con Firebase:", user);
                }
            });
        }
    </script>
</head>
<body>
    <div class="cerrar-sesion-container">
        <a href="../Controlador/cerrar_sesion.php" class="cerrar-sesion-boton">
             Cerrar Sesión
        </a>
    </div>
    <div class="wrapper">
        <header class="header-mobile">
            <h1 class="logo">Piston Rojo</h1>
            <button class="open-menu" id="open-menu">
                <i class="bi bi-list"></i>
            </button>
        </header>
        <aside>
            <button class="close-menu" id="close-menu">
                <i class="bi bi-x"></i>
            </button>
            <header>
                <h1 class="logo">
                    <a href="../Index.php">
                        <img class="dv" src="../imagenes/Logo.png" alt="Piston Rojo Logo">
                    </a>
                    Piston Rojo
                </h1>
            </header>
            <nav>
                <ul class="menu">
                    <li>
                        <a href="indexjv.php" class="boton-menu boton-categoria active"><i class="bi bi-house-door-fill"></i> Inicio</a>
                    </li>
                    <li>
                        <a href="../Controlador/controladorProducto.php" class="boton-menu boton-categoria"><i class="bi bi-list-ul"></i> Productos</a>
                    </li>
                    <li>
                        <a href="http://127.0.0.1:8000/admin" class="boton-menu boton-categoria"><i class="bi bi-calendar"></i> Citas</a>
                    </li>
                    <li>
                        <a href="../Controlador/controladorproveedor.php" class="boton-menu boton-categoria"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                            <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                          </svg> Provedores</a>
                    </li>
                </ul>
            </nav>
            <footer>
                <p class="texto-footer">© 2024 Piston Rojo</p>
            </footer>
        </aside>
        <main class="PR">
            <h2 class="titulo-principal" id="titulo-principal">Bienvenido Administrador</h2>
            <div id="contenedor-productos" class="contenedor-productos">
                <!-- Aquí va el contenido dinámico de productos -->
            </div>
        </main>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>
</html>
