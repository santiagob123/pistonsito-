<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../a.png" type="image/x-icon">
    <style>
    body {
            background-color: #961818;
            color: #ffffff;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #000000;
            font-size: 26px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            border-bottom: 1px solid #e74c3c;
            padding-bottom: 5px;
        }

        .btn-secondary, .btn-primary, .btn-warning {
            border: 1px solid #e74c3c;
        }

        .btn-secondary:hover, .btn-primary:hover {
            background-color: #e74c3c;
        }

        .btn-warning:hover {
            background-color: #e67e22;
        }

        .modal-header {
            background-color: #000000;
            color: #ffffff;
        }

        .modal-footer {
            background-color: #961818;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .btn-secondary {
            background-color: #000000;
            color: #ffffff;
            border: 1px solid #e74c3c;
        }

        .btn-primary {
            background-color: #000000;
            color: #ffffff;
            border: 1px solid #e74c3c;
        }

        /* Cambiar el color del texto de las etiquetas (labels) a negro */
        label {
            color: #000000;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-3">Proveedores</h1>
    <div class="button-container">
        <a class="btn btn-secondary" href="../indexjv.html">Volver al menú principal</a>
        <form action="../Controlador/controladorProveedor.php" method="post">
            <button class="btn btn-primary" type="submit" name="Acciones" value="Refrescar tabla">Refrescar tabla</button>
        </form>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Proveedor</th>
                    <th>NIT</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($resultado) && $resultado->num_rows > 0) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $fila['Id_Prov'] . "</td>";
                        echo "<td>" . htmlspecialchars($fila['Prov_Numero_NIT']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['Prov_Nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['Prov_Telefono']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['Prov_Email']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['Prov_Direccion']) . "</td>";
                        echo "<td>" . ($fila['Prov_Estado'] == 1 ? 'Activo' : 'Inactivo') . "</td>";
                        echo '<td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal' . $fila['Id_Prov'] . '">Editar</button></td>';
                        echo "</tr>";

                        // Modal para editar proveedor
                        echo '<div class="modal fade" id="editModal' . $fila['Id_Prov'] . '" tabindex="-1" aria-labelledby="editModalLabel' . $fila['Id_Prov'] . '" aria-hidden="true">';
                        echo '  <div class="modal-dialog">';
                        echo '      <div class="modal-content">';
                        echo '          <div class="modal-header">';
                        echo '              <h5 class="modal-title" id="editModalLabel' . $fila['Id_Prov'] . '">Editar Proveedor</h5>';
                        echo '              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '          </div>';
                        echo '          <div class="modal-body">';
                        echo '              <form action="../Controlador/controladorProveedor.php" method="post">';
                        echo '                  <input type="hidden" name="Id_Prov" value="' . $fila['Id_Prov'] . '">';
                        echo '                  <div class="mb-3">
                                <label for="Prov_Numero_NIT" class="form-label">NIT</label>
                                <input class="form-control" name="Prov_Numero_NIT" type="text" value="' . htmlspecialchars($fila['Prov_Numero_NIT']) . '" required>
                              </div>';
                        echo '                  <div class="mb-3">
                                <label for="Prov_Nombre" class="form-label">Nombre</label>
                                <input class="form-control" name="Prov_Nombre" type="text" value="' . htmlspecialchars($fila['Prov_Nombre']) . '" required>
                              </div>';
                        echo '                  <div class="mb-3">
                                <label for="Prov_Telefono" class="form-label">Teléfono</label>
                                <input class="form-control" name="Prov_Telefono" type="text" value="' . htmlspecialchars($fila['Prov_Telefono']) . '" required>
                              </div>';
                        echo '                  <div class="mb-3">
                                <label for="Prov_Email" class="form-label">Email</label>
                                <input class="form-control" name="Prov_Email" type="email" value="' . htmlspecialchars($fila['Prov_Email']) . '" required>
                              </div>';
                        echo '                  <div class="mb-3">
                                <label for="Prov_Direccion" class="form-label">Dirección</label>
                                <input class="form-control" name="Prov_Direccion" type="text" value="' . htmlspecialchars($fila['Prov_Direccion']) . '" required>
                              </div>';
                        echo '                  <div class="mb-3">
                                <label for="Prov_Estado" class="form-label">Estado</label>
                                <select class="form-select" name="Prov_Estado">
                                    <option value="1"' . ($fila['Prov_Estado'] == 1 ? ' selected' : '') . '>Activo</option>
                                    <option value="0"' . ($fila['Prov_Estado'] == 0 ? ' selected' : '') . '>Inactivo</option>
                                </select>
                              </div>';
                        echo '                  <button class="btn btn-warning" type="submit" name="Acciones" value="Actualizar Proveedor">Guardar Cambios</button>';
                        echo '              </form>';
                        echo '          </div>';
                        echo '      </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                } else {
                    echo "<tr><td colspan='8'>No hay proveedores registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Botón para agregar proveedor -->
    <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#addModal">Agregar Proveedor</button>

    <!-- Modal para agregar proveedor -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Agregar Nuevo Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../Controlador/controladorProveedor.php" method="post">
                        <div class="mb-3">
                            <label for="Prov_Numero_NIT" class="form-label">NIT</label>
                            <input class="form-control" id="Prov_Numero_NIT" name="Prov_Numero_NIT" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="Prov_Nombre" class="form-label">Nombre</label>
                            <input class="form-control" id="Prov_Nombre" name="Prov_Nombre" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="Prov_Telefono" class="form-label">Teléfono</label>
                            <input class="form-control" id="Prov_Telefono" name="Prov_Telefono" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="Prov_Email" class="form-label">Email</label>
                            <input class="form-control" id="Prov_Email" name="Prov_Email" type="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="Prov_Direccion" class="form-label">Dirección</label>
                            <input class="form-control" id="Prov_Direccion" name="Prov_Direccion" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="Prov_Estado" class="form-label">Estado</label>
                            <select class="form-select" name="Prov_Estado">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit" name="Acciones" value="Agregar Proveedor">Agregar Proveedor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
