<!DOCTYPE html>
<html lang="es">
<script type="module">
        // Configuración de Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyBCerg-Tzv85bHEbxsgNScGoJ65w2W7tmM",
            authDomain: "pistonrojo-d4bfb.firebaseapp.com",
            projectId: "pistonrojo-d4bfb",
            storageBucket: "pistonrojo-d4bfb.firebasestorage.app",
            messagingSenderId: "709609617298",
            appId: "1:709609617298:web:63676148d5ebd3c8e5334b",
            measurementId: "G-PNRT5H6ZT0"
        };

        // Importar Firebase
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
        import { getAuth, GoogleAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-auth.js";

        // Inicializar Firebase
        const app = initializeApp(firebaseConfig);

        // Obtener la referencia de autenticación
        const auth = getAuth(app);
        const googleProvider = new GoogleAuthProvider();

        // Función para iniciar sesión con Google
        function googleLogin() {
            signInWithPopup(auth, googleProvider)
                .then(result => {
                    const user = result.user;
                    console.log("Usuario autenticado con Google:", user);
                    
                    // Redirigir según el usuario o algún criterio
                    if (user.email === "santobernalvega@gmail.com") {
                        window.location.href = "indexjv.html"; // Redirigir a la página de administrador
                    } else {
                        window.location.href = "GestionUsuario.html";  // Redirigir a la página de usuario normal
                    }
                })
                .catch(error => {
                    console.error("Error al iniciar sesión con Google:", error.message);
                });
        }

        // Asegúrate de que googleLogin esté disponible después de que el documento esté listo
        window.googleLogin = googleLogin;  // Esto permite que el botón en el HTML ejecute la función
    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro e Inicio de Sesión</title>
<link rel="stylesheet" href="../css/ini_de_sesion.css">
    <script>
        function showForm(formId) {
            document.querySelectorAll('.form-content').forEach(form => {
                form.classList.remove('active');
            });
            document.getElementById(formId).classList.add('active');

            document.querySelectorAll('.form-header button').forEach(btn => btn.classList.remove('active'));
            document.getElementById('btn-' + formId).classList.add('active');
        }

        window.onload = function () {
            showForm('login');
        };
    </script>
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <a href="../index.php">
                <img src="http://localhost/piston_rojo/imagenes/logo.png" alt="Logo">
            </a>
            <div class="button-container">
                <button id="btn-login" onclick="showForm('login')" class="active">Iniciar Sesión</button>
                <button id="btn-register" onclick="showForm('register')">Registrarse</button>
            </div>
        </div>

        <!-- Formulario de Inicio de Sesión -->
        <div id="login" class="form-content active">
            <h2>Iniciar Sesión</h2>
            <form action="../Controlador/controladorLogin.php" method="POST">
                <label for="loginEmail">Email:</label>
                <input type="email" id="loginEmail" name="userEmail" placeholder="Correo electrónico" required>

                <label for="loginPassword">Contraseña:</label>
                <input type="password" id="loginPassword" name="userPassword" placeholder="Contraseña" required >

                <button type="submit">Iniciar Sesión</button>
            </form>
             <!-- Botón para iniciar sesión con Google -->
             <button id="google-login-btn" onclick="googleLogin()">Iniciar sesión con Google</button>
        </div>

        <!-- Formulario de Registro -->
        <div id="register" class="form-content">
            <h2>Registrarse</h2>
            <form action="../Controlador/controladorUsuario.php" method="POST">
                <input type="hidden" name="accion" value="registrar"> <!-- Campo oculto para registrar -->
                <div class="form-grid">
                    <div>
                        <label for="tipoDocumento">Tipo de Documento:</label>
                        <select id="tipoDocumento" name="tipoDocumento" required>
                            <option value="">Seleccione una opción</option>
                            <option value="CC">Cédula de Ciudadanía (CC)</option>
                            <option value="TI">Tarjeta de Identidad (TI)</option>
                            <option value="CE">Cédula de Extranjería (CE)</option>
                            <option value="PAS">Pasaporte (PAS)</option>
                        </select>
                    </div>
                    <div>
                        <label for="numeroDocumento">Número de Documento:</label>
                        <input type="text" id="numeroDocumento" name="numeroDocumento" placeholder="Número de documento" required pattern="\d+" minlength="6" maxlength="12">
                    </div>
                    <div>
                        <label for="userName">Nombre:</label>
                        <input type="text" id="userName" name="userName" placeholder="Nombre" required minlength="3">
                    </div>
                    <div>
                        <label for="userApellido">Apellido:</label>
                        <input type="text" id="userApellido" name="userApellido" placeholder="Apellido" required minlength="3">
                    </div>
                    <div>
                        <label for="userTelefono">Teléfono:</label>
                        <input type="tel" id="userTelefono" name="userTelefono" placeholder="Teléfono" required pattern="\d{10}" title="Debe ser un número de 10 dígitos">
                    </div>
                    <div>
                        <label for="userDireccion">Dirección:</label>
                        <input type="text" id="userDireccion" name="userDireccion" placeholder="Dirección" required minlength="5">
                    </div>
                    <div class="form-grid-full">
                        <label for="userEmail">Correo Electrónico:</label>
                        <input type="email" id="userEmail" name="userEmail" placeholder="Correo Electrónico" required>
                    </div>
                    <div class="form-grid-full">
                        <label for="userPassword">Contraseña:</label>
                        <input type="password" id="userPassword" name="userPassword" placeholder="Contraseña" required minlength="6">
                    </div>
                </div>
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>
</body>

</html>

    
    