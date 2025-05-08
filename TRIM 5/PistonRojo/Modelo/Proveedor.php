<?php
require_once 'Conexion.php'; // Incluir archivo de conexión

class Proveedor {
    private $conexion;

    public function __construct() {
        $this->conexion = Conectarse(); // Obtener conexión a la base de datos
    }

    public function agregarProveedor($id, $numeroNIT, $nombre, $telefono, $direccion, $email, $estado) {
        $sql = "INSERT INTO Proveedores (Prov_Numero_NIT, Prov_Nombre, Prov_Telefono, Prov_Direccion, Prov_Email, Prov_Estado) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('issssi', $numeroNIT, $nombre, $telefono, $direccion, $email, $estado);
        $stmt->execute();
        $stmt->close();
    }

    public function actualizarProveedor($id, $numeroNIT, $nombre, $telefono, $direccion, $email, $estado) {
        $sql = "UPDATE Proveedores SET Prov_Numero_NIT = ?, Prov_Nombre = ?, Prov_Telefono = ?, Prov_Direccion = ?, Prov_Email = ?, Prov_Estado = ? WHERE Id_Prov = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('issssii', $numeroNIT, $nombre, $telefono, $direccion, $email, $estado, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function eliminarProveedor($id) {
        $sql = "DELETE FROM Proveedores WHERE Id_Prov = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    public function consultarProveedores() {
        $sql = "SELECT * FROM Proveedores";
        $resultado = $this->conexion->query($sql);
        return $resultado;
    }
}
?>
