<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../a.png" type="image/x-icon">
    <style>
        body {
            background-color: #961818;
            color: #ffffff; /* Texto blanco */
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
            border-bottom: 1px solid #e74c3c; /* Línea roja debajo del encabezado */
            padding-bottom: 5px;
        }

        h3{
            color: #000000;
            font-size: 26px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        
            padding-bottom: 5px;  
        }

         

        .container {
            background-color: #ffffff; /* Fondo blanco */
            color: #000000; /* Texto negro */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

       
        .btn-secondary {
            background-color: #000000; /* Fondo negro */
            color: #ffffff; /* Texto blanco */
            border: 1px solid #e74c3c; /* Borde rojo */
        }

        .btn-secondary:hover {
            background-color: #e74c3c; /* Fondo rojo al pasar el ratón */
            color: #ffffff; /* Texto blanco */
            border: 1px solid #e74c3c; /* Borde rojo */
        }

        .btn-primary {
            background-color: #000000; /* Fondo negro */
            color: #ffffff; /* Texto blanco */
            border: 1px solid #e74c3c; /* Borde rojo */
        }

        .btn-primary:hover {
            background-color: #e74c3c; 
        }

        .btn-warning {
            background-color: #fff8cb;
    color: #000000;
    --bs-btn-border-color: #e74c3c; 
        }

        .btn-warning:hover {
            background-color: #e67e22; 
        }

        .btn-success {
            background-color: #2ecc71; /* Verde para los botones de éxito */
            color: #ffffff; /* Texto blanco */
        }

        .btn-success:hover {
            background-color: #27ae60; /* Verde más oscuro al pasar el ratón */
        }

        .modal-header {
            background-color: #000000;
            color: #ffffff;
        }
        
        .modal-footer {
            background-color: #f8f9fa; /* Fondo claro para el pie del modal */
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
          

        
    

       
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-3">Productos</h1>
    <div class="button-container">
        <a class="btn btn-secondary" href="../indexjv.html">Volver al menú principal</a>
        <form action="../Controlador/controladorProducto.php" method="post">
            <button class="btn btn-primary" type="submit" name="Acciones" value="Refrescar tabla">Refrescar tabla</button>
        </form>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Referencia</th>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Marca</th>
                    <th>Proveedor</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['Id_Pro'] . "</td>";
                    echo "<td>" . htmlspecialchars($fila['Pro_ProductoRef']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['Pro_Nombre']) . "</td>";
                    echo "<td>" . $fila['Pro_Stock'] . "</td>";
                    echo "<td>" . $fila['Pro_Precio'] . "</td>";
                    echo "<td>" . $fila['Pro_Marca'] . "</td>";
                    
                    // Obtener el nombre del proveedor
                    // Suponiendo que tienes una consulta JOIN en el controlador, de lo contrario necesitarías una consulta adicional
                    echo "<td>" . htmlspecialchars($fila['Prov_Nombre']) . "</td>";
                    
                    // Obtener el nombre de la categoría
                    echo "<td>" . htmlspecialchars($fila['Cat_Nombre']) . "</td>";
                    
                    // Obtener el nombre del estado del producto
                    echo "<td>" . htmlspecialchars($fila['Estp_Descripcion']) . "</td>";
                    
                    // Botón para actualizar
                    echo '<td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal' . $fila['Id_Pro'] . '">Editar</button>
                          </td>';

                    // Modal para actualizar producto
                    echo '<div class="modal fade" id="updateModal' . $fila['Id_Pro'] . '" tabindex="-1" aria-labelledby="updateModalLabel' . $fila['Id_Pro'] . '" aria-hidden="true">';
                    echo '  <div class="modal-dialog">';
                    echo '      <div class="modal-content">';
                    echo '          <div class="modal-header">';
                    echo '              <h5 class="modal-title" id="updateModalLabel' . $fila['Id_Pro'] . '">Actualizar Producto - ID: ' . $fila['Id_Pro'] . '</h5>';
                    echo '              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '          </div>';
                    echo '          <div class="modal-body">';
                    echo '              <form action="../Controlador/controladorProducto.php" method="post">';
                    echo '                  <input type="hidden" name="Id_Pro" value="' . $fila['Id_Pro'] . '">';
                    echo '                  <div class="mb-3">
                                <label class="form-label">Referencia</label>
                                <input class="form-control" name="Pro_ProductoRef" type="text" value="' . htmlspecialchars($fila['Pro_ProductoRef']) . '" required>
                              </div>';
                    echo '                  <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input class="form-control" name="Pro_Nombre" type="text" value="' . htmlspecialchars($fila['Pro_Nombre']) . '" required>
                              </div>';
                    echo '                  <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input class="form-control" name="Pro_Stock" type="number" value="' . $fila['Pro_Stock'] . '" required>
                              </div>';
                    echo '                  <div class="mb-3">
                                <label class="form-label">Precio</label>
                                <input class="form-control" name="Pro_Precio" type="number" step="0.01" value="' . $fila['Pro_Precio'] . '" required>
                              </div>';
                    echo '                  <div class="mb-3">
                                <label class="form-label">Marca</label>
                                <input class="form-control" name="Pro_marca" type="text" value="' . $fila['Pro_Marca'] . '" required>
                              </div>';
                    echo '                  <div class="mb-3">
                                <label class="form-label">Proveedor</label>
                                <select class="form-select" name="Proveedores_Id_Prov" required>';

                    
                    // Obtener proveedores para el select
                    mysqli_data_seek($proveedores, 0); // Reiniciar el puntero
                    while ($prov = mysqli_fetch_assoc($proveedores)) {
                        $selected = ($prov['Id_Prov'] == $fila['Proveedores_Id_Prov']) ? ' selected' : '';
                        echo '<option value="' . $prov['Id_Prov'] . '"' . $selected . '>' . htmlspecialchars($prov['Prov_Nombre']) . '</option>';
                    }
                    echo '                  </select>
                              </div>';
                    
                    echo '                  <div class="mb-3">
                                <label class="form-label">Categoría</label>
                                <select class="form-select" name="Categoria_Id_Cat" required>';
                    
                    // Obtener categorías para el select
                    mysqli_data_seek($categorias, 0); // Reiniciar el puntero
                    while ($cat = mysqli_fetch_assoc($categorias)) {
                        $selected = ($cat['Id_Cat'] == $fila['Categoria_Id_Cat']) ? ' selected' : '';
                        echo '<option value="' . $cat['Id_Cat'] . '"' . $selected . '>' . htmlspecialchars($cat['Cat_Nombre']) . '</option>';
                    }
                    echo '                  </select>
                              </div>';
                    
                    echo '                  <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" name="Id_EstadoP" required>';
                    
                    // Obtener estados del producto para el select
                    mysqli_data_seek($estadosProducto, 0); // Reiniciar el puntero
                    while ($est = mysqli_fetch_assoc($estadosProducto)) {
                        $selected = ($est['Id_EstadoP'] == $fila['Id_EstadoP']) ? ' selected' : '';
                        echo '<option value="' . $est['Id_EstadoP'] . '"' . $selected . '>' . htmlspecialchars($est['Estp_Descripcion']) . '</option>';
                    }
                    echo '                  </select>
                              </div>';
                    
                    echo '                  <button class="btn btn-warning" type="submit" name="Acciones" value="Actualizar Producto">Actualizar Producto</button>';
                    echo '              </form>';
                    echo '          </div>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }
                ?>
            </tbody>
        </table>
    </div>

<!-- Botón para abrir el modal de agregar producto -->
<button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Agregar Producto</button>

<!-- Modal para agregar producto -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Agregar Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../Controlador/controladorProducto.php" method="post">
                    <div class="mb-3">
                        <label for="Pro_ProductoRef" class="form-label">Referencia</label>
                        <input class="form-control" id="Pro_ProductoRef" name="Pro_ProductoRef" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="Pro_Nombre" class="form-label">Nombre</label>
                        <input class="form-control" id="Pro_Nombre" name="Pro_Nombre" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="Pro_Stock" class="form-label">Stock</label>
                        <input class="form-control" id="Pro_Stock" name="Pro_Stock" type="number" required>
                    </div>
                    <div class="mb-3">
                        <label for="Pro_Precio" class="form-label">Precio</label>
                        <input class="form-control" id="Pro_Precio" name="Pro_Precio" type="number" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="Pro_Marca" class="form-label">Marca</label>
                        <input class="form-control" id="Pro_Marca" name="Pro_Marca" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="Proveedores_Id_Prov" class="form-label">Proveedor</label>
                        <select class="form-select" id="Proveedores_Id_Prov" name="Proveedores_Id_Prov" required>
                            <option value="">Seleccione un proveedor</option>
                            <?php 
                            mysqli_data_seek($proveedores, 0); // Reiniciar el puntero
                            while ($prov = mysqli_fetch_assoc($proveedores)) {
                                $selected = ($prov['Id_Prov'] == $fila['Proveedores_Id_Prov']) ? ' selected' : '';
                                echo '<option value="' . $prov['Id_Prov'] . '"' . $selected . '>' . htmlspecialchars($prov['Prov_Nombre']) . '</option>';
                            } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Categoria_Id_Cat" class="form-label">Categoría</label>
                        <select class="form-select" id="Categoria_Id_Cat" name="Categoria_Id_Cat" required>
                            <option value="">Seleccione una categoría</option>
                            <?php 
                            mysqli_data_seek($categorias, 0); // Reiniciar el puntero
                            while ($cat = mysqli_fetch_assoc($categorias)) {
                                $selected = ($cat['Id_Cat'] == $fila['Categoria_Id_Cat']) ? ' selected' : '';
                                echo '<option value="' . $cat['Id_Cat'] . '"' . $selected . '>' . htmlspecialchars($cat['Cat_Nombre']) . '</option>';
                            } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Id_EstadoP" class="form-label">Estado</label>
                        <select class="form-select" id="Id_EstadoP" name="Id_EstadoP" required>
                            <option value="">Seleccione un estado</option>
                            <?php 
                            mysqli_data_seek($estadosProducto, 0); // Reiniciar el puntero
                            while ($est = mysqli_fetch_assoc($estadosProducto)) {
                                $selected = ($est['Id_EstadoP'] == $fila['Id_EstadoP']) ? ' selected' : '';
                                echo '<option value="' . $est['Id_EstadoP'] . '"' . $selected . '>' . htmlspecialchars($est['Estp_Descripcion']) . '</option>';
                            } ?>
                        </select>
                    </div>

                    <button class="btn btn-success" type="submit" name="Acciones" value="Crear Producto">Crear Producto</button>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Botón para cerrar el modal -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

