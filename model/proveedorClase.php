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

    // Devuelve HTML del reporte de proveedores
    public function reportePdf()
    {
        $rows = $this->listarProveedor();
        ob_start();
        ?>
        <style>
            body { font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial; background: #f8fafc; }
            .pagina { max-width: 1000px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: .6rem; border: 1px solid #e6eef6; text-align: left; }
            thead th { background: #f1f5f9; font-weight: 600; }
        </style>
        <div class="pagina" id="reporte-contenido">
            <h3 style="margin:0">Reporte de Proveedores</h3>
            <div style="color:#64748b;font-size:.9rem;margin-bottom:8px;">Listado de proveedores</div>
            <table>
                <thead>
                    <tr><th>ID</th><th>Empresa</th><th>Contacto</th><th>Teléfono</th></tr>
                </thead>
                <tbody>
                <?php if (!empty($rows)): foreach ($rows as $r): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($r['id_proveedor'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($r['empresa'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($r['contacto'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($r['telefono'] ?? '', ENT_QUOTES) ?></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="4" class="text-center text-muted py-3">No hay registros</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
        return ob_get_clean();
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

