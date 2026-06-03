<?php

class Proveedor
{
    private $id;
    private $empresa;
    private $contacto;
    private $mail;
    private $telefono;
    private $direccion;
    private $logo;
    private $db;

    public function __construct($id, $emp, $con, $mail, $tel, $dir, $logo)
    {
        $this->id = $id;
        $this->empresa = htmlspecialchars($emp, ENT_QUOTES, 'UTF-8');
        $this->contacto = htmlspecialchars($con, ENT_QUOTES, 'UTF-8');
        $this->mail = htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
        $this->telefono = htmlspecialchars($tel, ENT_QUOTES, 'UTF-8');
        $this->direccion = htmlspecialchars($dir, ENT_QUOTES, 'UTF-8');
        $this->logo = $logo;

        include_once("conexion.php");
        $this->db = Conexion::getInstance();
    }

    // INSERTAR
    public function grabarProveedor()
    {
        $sql = "INSERT INTO proveedor 
        (empresa, contacto, mail, telefono, direccion, logo)
        VALUES (:emp, :con, :mail, :tel, :dir, :logo)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':emp', $this->empresa);
        $stmt->bindParam(':con', $this->contacto);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':tel', $this->telefono);
        $stmt->bindParam(':dir', $this->direccion);
        $stmt->bindParam(':logo', $this->logo);

        return $stmt->execute();
    }

    // LISTAR
    public function listarProveedor()
    {
        $stmt = $this->db->query("SELECT * FROM proveedor");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ELIMINAR
    public function eliminarProveedor()
    {
        $stmt = $this->db->prepare("DELETE FROM proveedor WHERE id_proveedor = :id");
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // BUSCAR
    public function buscarProveedor($busqueda)
    {
        $busqueda = htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8');

        $sql = "SELECT * FROM proveedor 
            WHERE empresa LIKE :b";

        $stmt = $this->db->prepare($sql);

        $param = "$busqueda%";
        $stmt->bindParam(':b', $param);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // LISTAR POR ID
    public function listarProveedorId()
    {
        $stmt = $this->db->prepare("SELECT * FROM proveedor WHERE id_proveedor = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // EDITAR
    public function editarProveedor($emp, $con, $mail, $tel, $dir, $logo)
    {
        $emp = htmlspecialchars($emp, ENT_QUOTES, 'UTF-8');
        $con = htmlspecialchars($con, ENT_QUOTES, 'UTF-8');
        $mail = htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
        $tel = htmlspecialchars($tel, ENT_QUOTES, 'UTF-8');
        $dir = htmlspecialchars($dir, ENT_QUOTES, 'UTF-8');

        if ($logo != "") {
            $sql = "UPDATE proveedor SET 
                empresa = :emp,
                contacto = :con,
                mail = :mail,
                telefono = :tel,
                direccion = :dir,
                logo = :logo
                WHERE id_proveedor = :id";
        } else {
            $sql = "UPDATE proveedor SET 
                empresa = :emp,
                contacto = :con,
                mail = :mail,
                telefono = :tel,
                direccion = :dir
                WHERE id_proveedor = :id";
        }

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':emp', $emp);
        $stmt->bindParam(':con', $con);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':dir', $dir);

        if ($logo != "") {
            $stmt->bindParam(':logo', $logo);
        }

        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}

