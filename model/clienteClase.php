<?php

class Cliente
{
    private $id;
    private $nit;
    private $razon;
    private $estado;
    private $db;

    public function __construct($i, $n, $ra, $es)
    {
        $this->id = $i;
        $this->nit = htmlspecialchars($n, ENT_QUOTES, 'UTF-8');
        $this->razon = htmlspecialchars($ra, ENT_QUOTES, 'UTF-8');
        $this->estado = $es;
        include_once("conexion.php");
        $this->db = Conexion::getInstance(); // Conexión PDO
    }

    public function grabarCliente()
    {
        $sql = "INSERT INTO cliente (nit_ci, razonsocial, estado) VALUES (:nit, :razon, :estado)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nit', $this->nit);
        $stmt->bindParam(':razon', $this->razon);
        $stmt->bindParam(':estado', $this->estado);
        return $stmt->execute();
    }

    public function listarCliente()
    {
        $stmt = $this->db->query("SELECT * FROM cliente WHERE estado='Activo'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarClienteInactivo()
    {
        $stmt = $this->db->query("SELECT * FROM cliente WHERE estado='Inactivo'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function activarCliente()
    {
        $stmt = $this->db->prepare("UPDATE cliente SET estado='Activo' WHERE id_cliente = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function inactivarCliente()
    {
        $stmt = $this->db->prepare("UPDATE cliente SET estado='Inactivo' WHERE id_cliente = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function listarClienteId()
    {
        $stmt = $this->db->prepare("SELECT * FROM cliente WHERE estado='Activo' AND id_cliente = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarCliente($cod, $rs, $ni)
    {
        $rs_safe = htmlspecialchars($rs, ENT_QUOTES, 'UTF-8');
        $ni_safe = htmlspecialchars($ni, ENT_QUOTES, 'UTF-8');

        $stmt = $this->db->prepare("UPDATE cliente SET razonsocial = :rs, nit_ci = :ni WHERE id_cliente = :cod");
        $stmt->bindParam(':rs', $rs_safe);
        $stmt->bindParam(':ni', $ni_safe);
        $stmt->bindParam(':cod', $cod, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function eliminarCliente()
    {
        $stmt = $this->db->prepare("DELETE FROM cliente WHERE id_cliente = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function buscarCliente($busqueda)
    {
        $busqueda = htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8');
        $stmt = $this->db->prepare("SELECT * FROM cliente WHERE razonsocial LIKE :busqueda AND estado='Activo'");
        $busquedaParam = "%$busqueda%";
        $stmt->bindParam(':busqueda', $busquedaParam);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscarClienteInac($busqueda)
    {
        $busqueda = htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8');
        $stmt = $this->db->prepare("SELECT * FROM cliente WHERE razonsocial LIKE :busqueda AND estado='Inactivo'");
        $busquedaParam = "$busqueda%";
        $stmt->bindParam(':busqueda', $busquedaParam);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Devuelve HTML del reporte de clientes (con estilos inline)
    public function reportePdf()
    {
        $rows = $this->listarCliente();
        ob_start();
        ?>
        <style>
            body { font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial; background: #f8fafc; }
            .pagina { max-width: 900px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: .6rem; border: 1px solid #e6eef6; text-align: left; }
            thead th { background: #f1f5f9; font-weight: 600; }
            .header { margin-bottom: 1rem; }
        </style>
        <div class="pagina" id="reporte-contenido">
            <div class="header">
                <h3 style="margin:0">Reporte de Clientes</h3>
                <div style="color:#64748b;font-size:.9rem">Listado de clientes</div>
            </div>
            <table>
                <thead><tr><th>ID</th><th>NIT/CI</th><th>Razón Social</th></th></tr></thead>
                <tbody>
                <?php if (!empty($rows)): foreach ($rows as $r): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($r['id_cliente'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($r['nit_ci'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($r['razonsocial'] ?? '', ENT_QUOTES) ?></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="3" class="text-center text-muted py-3">No hay registros</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
        return ob_get_clean();
    }

    // Getters y setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setNit($nit)
    {
        $this->nit = htmlspecialchars($nit, ENT_QUOTES, 'UTF-8');
    }
    public function getNit()
    {
        return $this->nit;
    }

    public function setRazon($ra)
    {
        $this->razon = htmlspecialchars($ra, ENT_QUOTES, 'UTF-8');
    }
    public function getRazon()
    {
        return $this->razon;
    }

    public function setEstado($es)
    {
        $this->estado = $es;
    }
    public function getEstado()
    {
        return $this->estado;
    }
}
