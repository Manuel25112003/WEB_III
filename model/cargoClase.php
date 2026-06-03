<?php

class Cargo
{
    private $id;
    private $cargo;
    private $db;

    public function __construct($i, $ca)
    {
        $this->id = $i;
        $this->cargo = htmlspecialchars($ca, ENT_QUOTES, 'UTF-8'); // Protección XSS
        include_once("conexion.php");
        $this->db = Conexion::getInstance(); // Conexión PDO
    }

    // REGISTRAR CARGO
    public function grabarCargo()
    {
        $sql = "INSERT INTO cargo (cargo) VALUES (:cargo)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':cargo', $this->cargo);
        return $stmt->execute();
    }

    // LISTAR CARGOS
    public function listarCargo()
    {
        $stmt = $this->db->query("SELECT * FROM cargo");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // LISTAR CARGO POR ID
    public function listarCargoId()
    {
        $stmt = $this->db->prepare("SELECT * FROM cargo WHERE id_cargo = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // EDITAR CARGO
    public function editarCargo($co, $ca)
    {
        $ca_safe = htmlspecialchars($ca, ENT_QUOTES, 'UTF-8');

        $stmt = $this->db->prepare("UPDATE cargo SET cargo = :ca WHERE id_cargo = :co");
        $stmt->bindParam(':ca', $ca_safe);
        $stmt->bindParam(':co', $co, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // ELIMINAR CARGO
    public function eliminarCargo()
    {
        $stmt = $this->db->prepare("DELETE FROM cargo WHERE id_cargo = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // BUSCAR CARGO
    public function buscarCargo($busqueda)
    {
        $busqueda_safe = htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8');
        $stmt = $this->db->prepare("SELECT * FROM cargo WHERE cargo LIKE :busqueda");
        $param = "$busqueda_safe%";
        $stmt->bindParam(':busqueda', $param);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // SETTERS Y GETTERS
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setCargo($ca)
    {
        $this->cargo = htmlspecialchars($ca, ENT_QUOTES, 'UTF-8');
    }
    public function getCargo()
    {
        return $this->cargo;
    }
}
