<?php
include_once '../Modelo/Conexion.php';

class CitaController {
    private $conexion;

    public function __construct() {
        $this->conexion = Conectarse(); // Mantén la conexión abierta
    }

    public function obtenerCitas() {
        $query = "SELECT * FROM cita";
        $result = mysqli_query($this->conexion, $query);
        
        $citas = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $citas[] = $row;
        }
        return $citas;
    }

    public function obtenerCitaPorId($id) {
        $query = "SELECT * FROM cita WHERE Id_Citas = $id";
        $result = mysqli_query($this->conexion, $query);
        return mysqli_fetch_assoc($result);
    }

    public function crearNuevaCita($data) {
        $fecha = $data['fecha'];
        $hora = $data['hora'];
        $estado = $data['estado'];

        $query = "INSERT INTO cita (Cit_Fecha, Cit_Hora, Id_estadoCita) VALUES ('$fecha', '$hora', '$estado')";
        mysqli_query($this->conexion, $query);
    }

    public function actualizarCita($data) {
        $id = $data['id'];
        $fecha = $data['fecha'];
        $hora = $data['hora'];
        $estado = $data['estado'];

        $query = "UPDATE cita SET Cit_Fecha='$fecha', Cit_Hora='$hora', Id_estadoCita='$estado' WHERE Id_Citas=$id";
        mysqli_query($this->conexion, $query);
    }

    public function eliminarCita($id) {
        $query = "DELETE FROM cita WHERE Id_Citas = $id";
        mysqli_query($this->conexion, $query);
    }

    public function guardarCita($data) {
        // Verificar si se está creando o actualizando
        if (isset($data['id']) && !empty($data['id'])) {
            // Lógica para actualizar la cita
            $this->actualizarCita($data);
        } else {
            // Lógica para crear una nueva cita
            $this->crearNuevaCita($data);
        }
        
        // Redirigir al inicio después de guardar o actualizar
        header('Location: ../Vista/citas.php?accion=listar');
        exit(); // Asegúrate de salir para evitar que el script continúe
    }
    
    }

?>
