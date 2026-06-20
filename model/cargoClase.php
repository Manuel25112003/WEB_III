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

    // Devuelve HTML del reporte de cargos
    public function reportePdf()
    {
        $rows = $this->listarCargo();
        ob_start();
        ?>
        <style>
            body { font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial; background: #f8fafc; }
            .pagina { max-width: 800px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: .6rem; border: 1px solid #e6eef6; text-align: left; }
            thead th { background: #f1f5f9; font-weight: 600; }
        </style>
        <div class="pagina" id="reporte-contenido">
            <h3 style="margin:0">Reporte de Cargos</h3>
            <div style="color:#64748b;font-size:.9rem;margin-bottom:8px;">Listado de cargos</div>
            <table>
                <thead>
                    <tr><th>ID</th><th>Cargo</th></tr>
                </thead>
                <tbody>
                <?php if (!empty($rows)): foreach ($rows as $r): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($r['id_cargo'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($r['cargo'] ?? '', ENT_QUOTES) ?></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="2" class="text-center text-muted py-3">No hay registros</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
        return ob_get_clean();
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
