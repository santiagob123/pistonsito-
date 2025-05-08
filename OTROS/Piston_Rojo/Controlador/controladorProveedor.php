<?php
require_once '../Modelo/Proveedor.php';

// Crear una instancia del gestor de proveedores
$gestorProveedor = new Proveedor();

// Determinar qué acción tomar
$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

try {
    // Manejar las acciones según el formulario enviado
    if ($elegirAcciones == 'Agregar Proveedor') {
        // Obtener los datos del formulario
        $numeroNIT = $_POST['Prov_Numero_NIT'];
        $nombre = $_POST['Prov_Nombre'];
        $telefono = $_POST['Prov_Telefono'];
        $direccion = $_POST['Prov_Direccion'];
        $email = $_POST['Prov_Email'];
        $estado = $_POST['Prov_Estado'];

        // Agregar el nuevo proveedor
        $gestorProveedor->agregarProveedor(null, $numeroNIT, $nombre, $telefono, $direccion, $email, $estado);

    } elseif ($elegirAcciones == 'Actualizar Proveedor') {
        $id = $_POST['Id_Prov'];
        $numeroNIT = $_POST['Prov_Numero_NIT'];
        $nombre = $_POST['Prov_Nombre'];
        $telefono = $_POST['Prov_Telefono'];
        $direccion = $_POST['Prov_Direccion'];
        $email = $_POST['Prov_Email'];
        $estado = $_POST['Prov_Estado'];

        // Actualizar el proveedor
        $gestorProveedor->actualizarProveedor($id, $numeroNIT, $nombre, $telefono, $direccion, $email, $estado);

    } elseif ($elegirAcciones == 'Eliminar Proveedor') {
        $gestorProveedor->eliminarProveedor($_POST['Id_Prov']);
    }

    // Obtener la lista actualizada de proveedores
    $resultado = $gestorProveedor->consultarProveedores();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Incluir la vista
include "../Vista/vistaProveedor.php";
?>
