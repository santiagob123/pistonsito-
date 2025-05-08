<?php
require_once '../Modelo/Producto.php';

// Crear una instancia del gestor de productos
$gestorProducto = new Producto();

// Obtener datos de proveedores, categorías y estados
$proveedores = $gestorProducto->obtenerProveedores();
$categorias = $gestorProducto->obtenerCategorias();
$estadosProducto = $gestorProducto->obtenerEstadosProducto();

// Determinar qué acción tomar
$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

try {
    // Manejar las acciones según el formulario enviado
    if ($elegirAcciones == 'Crear Producto') {
        $productoRef = $_POST['Pro_ProductoRef'];
        $nombre = $_POST['Pro_Nombre'];
        $stock = $_POST['Pro_Stock'];
        $precio = $_POST['Pro_Precio'];
        $marca = $_POST['Pro_Marca'];
        $proveedor = $_POST['Proveedores_Id_Prov'];
        $categoria = $_POST['Categoria_Id_Cat'];
        $estado = $_POST['Id_EstadoP'];

        // Agregar el nuevo producto
        $gestorProducto->agregarProducto($productoRef, $nombre, $stock, $precio, $marca, $proveedor, $categoria, $estado);

        // Actualizar las listas para los selects después de agregar
        $proveedores = $gestorProducto->obtenerProveedores();
        $categorias = $gestorProducto->obtenerCategorias();
        $estadosProducto = $gestorProducto->obtenerEstadosProducto();

    } elseif ($elegirAcciones == 'Actualizar Producto') {
        $gestorProducto->actualizarProducto(
            $_POST['Id_Pro'],
            $_POST['Pro_ProductoRef'],
            $_POST['Pro_Nombre'],
            $_POST['Pro_Stock'],
            $_POST['Pro_Precio'],
            $_POST['Pro_marca'],
            $_POST['Proveedores_Id_Prov'],
            $_POST['Categoria_Id_Cat'],
            $_POST['Id_EstadoP']
        );

        // Actualizar las listas para los selects después de actualizar
        $proveedores = $gestorProducto->obtenerProveedores();
        $categorias = $gestorProducto->obtenerCategorias();
        $estadosProducto = $gestorProducto->obtenerEstadosProducto();

    } 

    // Obtener la lista actualizada de productos con JOIN
    $resultado = $gestorProducto->consultarProductos();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Incluir la vista
include "../Vista/vistaProducto.php";
?>
