<?php

class Empleado
{
    private $id;
    private $idcargo;
    private $ci;
    private $nombre;
    private $paterno;
    private $materno;
    private $direccion;
    private $telefono;
    private $fecha_nacimiento;
    private $genero;
    private $intereses;
    private $db;

    public function __construct($id, $idcargo, $ci, $nom, $pat, $mat, $dir, $tel, $fec, $gen, $int)
    {
        $this->id = $id;
        $this->idcargo = $idcargo;
        $this->ci = htmlspecialchars($ci, ENT_QUOTES, 'UTF-8');
        $this->nombre = htmlspecialchars($nom, ENT_QUOTES, 'UTF-8');
        $this->paterno = htmlspecialchars($pat, ENT_QUOTES, 'UTF-8');
        $this->materno = htmlspecialchars($mat, ENT_QUOTES, 'UTF-8');
        $this->direccion = htmlspecialchars($dir, ENT_QUOTES, 'UTF-8');
        $this->telefono = htmlspecialchars($tel, ENT_QUOTES, 'UTF-8');
        $this->fecha_nacimiento = $fec;
        $this->genero = $gen;

        // 🔥 INTERESES (array → string)
        if (is_array($int)) {
            $int = implode(", ", $int);
        }
        $this->intereses = htmlspecialchars($int, ENT_QUOTES, 'UTF-8');

        include_once("conexion.php");
        $this->db = Conexion::getInstance();
    }

    // INSERTAR
    public function grabarEmpleado()
    {
        $sql = "INSERT INTO empleado 
        (id_cargo, ci, nombre, paterno, materno, direccion, telefono, fechanacimiento, genero, intereses)
        VALUES (:idcargo, :ci, :nombre, :paterno, :materno, :direccion, :telefono, :fecha, :genero, :intereses)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':idcargo', $this->idcargo);
        $stmt->bindParam(':ci', $this->ci);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':paterno', $this->paterno);
        $stmt->bindParam(':materno', $this->materno);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':fecha', $this->fecha_nacimiento);
        $stmt->bindParam(':genero', $this->genero);
        $stmt->bindParam(':intereses', $this->intereses);

        return $stmt->execute();
    }

    // LISTAR
    public function listarEmpleado()
    {
        $sql = "SELECT e.*, c.cargo 
                FROM empleado e
                INNER JOIN cargo c ON e.id_cargo = c.id_cargo";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // POR ID
    public function listarEmpleadoId()
    {
        $stmt = $this->db->prepare("SELECT * FROM empleado WHERE id_empleado = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // BUSCAR
    // BUSCAR POR CI Y CARGO
// BUSCAR POR CI, CARGO Y NOMBRE
public function buscarEmpleado($dato)
{
    $sql = "SELECT e.*, c.cargo 
            FROM empleado e
            INNER JOIN cargo c ON e.id_cargo = c.id_cargo
            WHERE e.ci LIKE :dato
            OR c.cargo LIKE :dato
            OR e.nombre LIKE :dato";

    $stmt = $this->db->prepare($sql);

    $dato = "%".$dato."%";
    $stmt->bindParam(':dato', $dato);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    // EDITAR
    public function editarEmpleado($idcargo, $ci, $nombre, $paterno, $materno, $direccion, $telefono, $fecha, $genero, $intereses)
    {
        if (is_array($intereses)) {
            $intereses = implode(", ", $intereses);
        }

        $intereses = htmlspecialchars($intereses, ENT_QUOTES, 'UTF-8');

        $sql = "UPDATE empleado SET 
        id_cargo = :idcargo,
        ci = :ci,
        nombre = :nombre,
        paterno = :paterno,
        materno = :materno,
        direccion = :direccion,
        telefono = :telefono,
        fechanacimiento = :fecha,
        genero = :genero,
        intereses = :intereses
        WHERE id_empleado = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':idcargo', $idcargo);
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':paterno', $paterno);
        $stmt->bindParam(':materno', $materno);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':intereses', $intereses);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // ELIMINAR
    public function eliminarEmpleado()
    {
        $stmt = $this->db->prepare("DELETE FROM empleado WHERE id_empleado = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Devuelve HTML del reporte de empleados
    public function reportePdf()
    {
        $rows = $this->listarEmpleado();
        ob_start();
        ?>
        <style>
            body { font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial; background: #f8fafc; }
            .pagina { max-width: 1100px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: .6rem; border: 1px solid #e6eef6; text-align: left; }
            thead th { background: #f1f5f9; font-weight: 600; }
        </style>
        <div class="pagina" id="reporte-contenido">
            <h3 style="margin:0">Reporte de Empleados</h3>
            <div style="color:#64748b;font-size:.9rem;margin-bottom:8px;">Listado de empleados</div>
            <table>
                <thead>
                    <tr><th>ID</th><th>CI</th><th>Nombre</th><th>Cargo</th><th>Teléfono</th></tr>
                </thead>
                <tbody>
                <?php if (!empty($rows)): foreach ($rows as $r): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($r['id_empleado'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($r['ci'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars(($r['nombre'] ?? '') . ' ' . ($r['paterno'] ?? ''), ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($r['cargo'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($r['telefono'] ?? '', ENT_QUOTES) ?></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="5" class="text-center text-muted py-3">No hay registros</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
        return ob_get_clean();
    }
}
