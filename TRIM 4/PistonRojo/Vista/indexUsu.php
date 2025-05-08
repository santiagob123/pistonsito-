<?php
session_start();
if (isset($_SESSION['usuario'])) {
    echo "<script>window.skipFirebaseCheck = true;</script>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Citas</title>
    <link rel="stylesheet" href="../css/estilosjv.css">
    
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5ISopW55GkEx6mAxJmesnHm3pF-Crx78&callback=console.debug&libraries=maps,marker&v=beta"></script>

    <script type="module">
        const firebaseConfig = {
            apiKey: "AIzaSyBCerg-Tzv85bHEbxsgNScGoJ65w2W7tmM",
            authDomain: "pistonrojo-d4bfb.firebaseapp.com",
            projectId: "pistonrojo-d4bfb",
            storageBucket: "pistonrojo-d4bfb.appspot.com", // corregido
            messagingSenderId: "709609617298",
            appId: "1:709609617298:web:63676148d5ebd3c8e5334b",
            measurementId: "G-PNRT5H6ZT0"
        };

        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
        import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-auth.js";

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        if (!window.skipFirebaseCheck) {
            onAuthStateChanged(auth, user => {
                if (!user) {
                    window.location.href = "ini_de_sesion.php";
                } else {
                    console.log("Usuario autenticado con Firebase:", user);
                }
            });
        }
    </script>
</head>

<body>
    <!-- Navegación -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="../Index.php"><img src="../imagenes/Logo.png" alt="Logo" class="logo"></a>
                <div class="ccerrar-sesion-container">
        <a href="../Controlador/cerrar_sesion.php" class="ccerrar-sesion-boton">
             Cerrar Sesión
        </a>
    </div>
            </div>
            <ul class="menu-navegacion">
                <li><a href="../Index.php">Inicio</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#agendar-cita" class="btn-agendar">Agendar una cita</a></li>
            </ul>
        </div>
    </nav>

    <!-- Encabezado -->
    <header id="agendar-cita" class="header">
        <h1>Piston Rojo</h1>
        <p>Si necesitas nuestro servicio con <strong>URGENCIA</strong> escríbenos a WhatsApp</p>
        <a href="tel:3103487220" class="btn-contacto">Contáctanos</a>
        <br>
        <p>Si necesitas agendar una cita puedes hacerlo aquí</p>
        <br><br><br>
        <li><a href="http://127.0.0.1:8000/citas" class="btn-contacto">Agenda Tu cita</a></li>
    </header>

    <!-- Sección de servicios -->
    <div class="text-and-image-section">
        <div id="servicios" class="text-and-image-container">
            <div class="text-box">
                <h1 class="text-large">Servicio de Piston Rojo Profesional</h1><br>
                <p class="text-medium">
                    En Piston Rojo nos apasiona la excelencia en el rendimiento de las motos. Nuestro servicio de puesta a punto incluye:<br><br>
                    - Ajustes precisos en el motor<br>
                    - Revisión exhaustiva de la suspensión<br>
                    - Optimización de la transmisión<br><br>
                    Además, llevamos a cabo un análisis completo de la seguridad para garantizar que tu moto esté lista para cualquier aventura en las carreteras.
                    Respaldamos nuestro trabajo con una garantía de satisfacción. Si no estás completamente satisfecho con nuestro servicio, trabajaremos contigo hasta que tu moto esté en perfecto estado.
                </p>
                <br><br>
                <a href="#agendar-cita">
                    <button class="action-button">▶ AGENDA TU CITA</button>
                </a>
            </div>
            <img src="../imagenes/22.png" alt="Servicio de Piston Rojo" class="right-image">
        </div>

        <div class="description-box">
            <p class="text-medium">
                Descubre la verdadera potencia y rendimiento de tu moto con Piston Rojo. ¡Reserva tu cita y experimenta un servicio diseñado para llevar tus trayectos al siguiente nivel!
            </p>
        </div>

        <div class="text-and-image-container">
            <div class="text-box">
                <h2 class="text-large">Beneficios Piston Rojo</h2><br><br>
                <p class="text-medium">
                    - Aumenta la potencia y eficiencia de tu moto<br>
                    - Mejora la estabilidad y maniobrabilidad en carretera<br>
                    - Prolonga la vida útil de tu moto con nuestro servicio preventivo<br>
                    - Experimenta un viaje suave y seguro en cada trayecto
                </p>
                <br><br>
                <a href="#agendar-cita">
                    <button class="action-button">▶ AGENDA TU CITA</button>
                </a>
            </div>
            <img src="../imagenes/11.png" alt="Beneficios Piston Rojo" class="right-image">
        </div>
    </div>

    <!-- Mapa de ubicación -->
    <div class="elementor-1240 elementor-element elementor-element-9ac4d4f"
        style="width: 80%; height: 400px; margin: 20px auto; display: flex; justify-content: center; align-items: center;">
        <gmp-map center="4.486197,-74.101221" zoom="19" map-id="DEMO_MAP_ID" style="width: 100%; height: 100%;">
            <gmp-advanced-marker position="4.486197,-74.101221" title="Cl. 114b Sur #7f Este-1"></gmp-advanced-marker>
        </gmp-map>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="contacts">
            <p>Contáctenos: +57 3053055073</p>
            <p>Ubicación: Calle 109 sur # 7 este 14, Bogotá, Colombia</p>
        </div>
        <div class="footer-links">
            <p><a href="#">Política Tratamiento de datos</a></p>
            <p><a href="#">Repositorio de motos</a></p>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/miltonjulio.vargasgonzalez" target="_blank">
                <img src="../imagenes/facebook.png" alt="Facebook">
            </a>
            <a href="https://www.whatsapp.com/" target="_blank">
                <img src="../imagenes/whatsap.jpg" alt="WhatsApp">
            </a>
        </div>
    </div>

    <!-- Redirección de formulario (si es necesario) -->
    <script>
        document.getElementById('myForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            window.location.href = 'Usuario2.php';
        });
    </script>
</body>

</html>
