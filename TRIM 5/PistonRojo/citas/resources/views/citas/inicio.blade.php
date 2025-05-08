<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    

    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1a1a1a;
            margin: 0;
            padding: 0;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        /* Títulos */
        h1 {
            font-size: 48px;
            color: #e60000;
            margin-bottom: 20px;
            font-weight: bold;
        }

        p {
            font-size: 18px;
            color: #ccc;
            margin-bottom: 30px;
        }

        /* Botón */
        button {
            padding: 15px 30px;
            font-size: 18px;
            color: #fff;
            background-color: #e60000;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #b50000;
        }
    </style>
</head>
<body>
    <h1>Bienvenido</h1>
    <p>Haz clic en el botón para crear una nueva cita.</p>
    <a href="{{ url('/citas/create') }}">
        <button>Empezar</button>
    </a>
    <br>
    <a href="{{ url('http://localhost/PistonRojo/Vista/indexUsu.php') }}">
        <button>volvel</button>
    </a>
</body>
</html>
