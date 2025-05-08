<?php
class Cita {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerCitas() {
        $query = $this->db->query("SELECT * FROM cita");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtenerCitaPorId($id) {
        $query = $this->db->prepare("SELECT * FROM cita WHERE Id_Citas = :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function crearCita($fecha, $hora, $estadoCita, $usuario) {
        $query = $this->db->prepare("INSERT INTO cita (Cit_Fecha, Cit_Hora, Id_estadoCita, Usuario_Id_Usu) VALUES (:fecha, :hora, :estadoCita, :usuario)");
        $query->bindParam(":fecha", $fecha);
        $query->bindParam(":hora", $hora);
        $query->bindParam(":estadoCita", $estadoCita);
        $query->bindParam(":usuario", $usuario);
        return $query->execute();
    }

    public function actualizarCita($id, $fecha, $hora, $estadoCita, $usuario) {
        $query = $this->db->prepare("UPDATE cita SET Cit_Fecha = :fecha, Cit_Hora = :hora, Id_estadoCita = :estadoCita, Usuario_Id_Usu = :usuario WHERE Id_Citas = :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":fecha", $fecha);
        $query->bindParam(":hora", $hora);
        $query->bindParam(":estadoCita", $estadoCita);
        $query->bindParam(":usuario", $usuario);
        return $query->execute();
    }

    public function eliminarCita($id) {
        $query = $this->db->prepare("DELETE FROM cita WHERE Id_Citas = :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        return $query->execute();
    }
}
?>
