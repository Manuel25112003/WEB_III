<?php

class Producto
{
    private $id;
    private $idProveedor;
    private $nombreproducto;
    private $descripcion;
    private $estado;
    private $precio;
    private $stock;
    private $tipo;
    private $imagen;
    private $db;

    public function __construct($id, $idProveedor, $nombreproducto, $descripcion, $estado, $precio, $stock, $tipo, $imagen)
    {
        $this->id = $id;
        $this->idProveedor = intval($idProveedor);
        $this->nombreproducto = htmlspecialchars($nombreproducto, ENT_QUOTES, 'UTF-8');
        $this->descripcion = htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8');
        $this->estado = htmlspecialchars($estado, ENT_QUOTES, 'UTF-8');
        $this->precio = $precio;
        $this->stock = intval($stock);
        $this->tipo = htmlspecialchars($tipo, ENT_QUOTES, 'UTF-8');
        $this->imagen = $imagen;

        include_once("conexion.php");
        $this->db = Conexion::getInstance();
    }

    public function grabarProducto()
    {
        $sql = "INSERT INTO producto (id_proveedor, nombreproducto, descripcion, estado, precio, stock, tipo, imagen) VALUES (:idProveedor, :nombreproducto, :descripcion, :estado, :precio, :stock, :tipo, :imagen)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idProveedor', $this->idProveedor, PDO::PARAM_INT);
        $stmt->bindParam(':nombreproducto', $this->nombreproducto);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':stock', $this->stock, PDO::PARAM_INT);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':imagen', $this->imagen);
        return $stmt->execute();
    }

    public function listarProducto()
    {
        $sql = "SELECT p.*, prov.empresa AS proveedor " .
               "FROM producto p " .
               "LEFT JOIN proveedor prov ON p.id_proveedor = prov.id_proveedor " .
               "WHERE p.estado = 'Activo'";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarProductoInactivo()
    {
        $sql = "SELECT p.*, prov.empresa AS proveedor " .
               "FROM producto p " .
               "LEFT JOIN proveedor prov ON p.id_proveedor = prov.id_proveedor " .
               "WHERE p.estado = 'Inactivo'";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inactivarProducto()
    {
        $stmt = $this->db->prepare("UPDATE producto SET estado='Inactivo' WHERE id_producto = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function activarProducto()
    {
        $stmt = $this->db->prepare("UPDATE producto SET estado='Activo' WHERE id_producto = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarProducto()
    {
        $stmt = $this->db->prepare("DELETE FROM producto WHERE id_producto = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function buscarProducto($busqueda)
    {
        $busqueda = htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8');
        $sql = "SELECT p.*, prov.empresa AS proveedor " .
               "FROM producto p " .
               "LEFT JOIN proveedor prov ON p.id_proveedor = prov.id_proveedor " .
                "WHERE nombreproducto LIKE :busqueda AND estado='Activo'";
        $stmt = $this->db->prepare($sql);
        $param = "$busqueda%";
        $stmt->bindParam(':busqueda', $param);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarProductoId()
    {
        $stmt = $this->db->prepare("SELECT * FROM producto WHERE id_producto = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarProducto($idProveedor, $nombreproducto, $descripcion, $estado, $precio, $stock, $tipo, $imagen)
    {
        $nombre_safe = htmlspecialchars($nombreproducto, ENT_QUOTES, 'UTF-8');
        $descripcion_safe = htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8');
        $estado_safe = htmlspecialchars($estado, ENT_QUOTES, 'UTF-8');
        $tipo_safe = htmlspecialchars($tipo, ENT_QUOTES, 'UTF-8');

        if ($imagen != "") {
            $sql = "UPDATE producto SET 
                id_proveedor = :idProveedor,
                nombreproducto = :nombreproducto,
                descripcion = :descripcion,
                estado = :estado,
                precio = :precio,
                stock = :stock,
                tipo = :tipo,
                imagen = :imagen
                WHERE id_producto = :id";
        } else {
            $sql = "UPDATE producto SET 
                id_proveedor = :idProveedor,
                nombreproducto = :nombreproducto,
                descripcion = :descripcion,
                estado = :estado,
                precio = :precio,
                stock = :stock,
                tipo = :tipo
                WHERE id_producto = :id";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
        $stmt->bindParam(':nombreproducto', $nombre_safe);
        $stmt->bindParam(':descripcion', $descripcion_safe);
        $stmt->bindParam(':estado', $estado_safe);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':tipo', $tipo_safe);

        if ($imagen != "") {
            $stmt->bindParam(':imagen', $imagen);
        }

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Devuelve el HTML completo del reporte (útil para generar PDFs)
    public function reportePdf()
    {
        $rows = $this->listarProducto();
        ob_start();
        ?>
        <style>
            body { font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial; background: #f8fafc; }
            .pagina { max-width: 1100px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: .6rem; border: 1px solid #e6eef6; text-align: left; }
            thead th { background: #f1f5f9; font-weight: 600; }
            .producto-img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; }
            .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        </style>

        <div class="pagina" id="reporte-contenido">
            <div class="header">
                <div>
                    <h3 style="margin:0">Reporte de Productos</h3>
                    <div style="color:#64748b;font-size:.9rem">Listado de productos</div>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Proveedor</th><th>Producto</th><th>Tipo</th>
                        <th>Precio</th><th>Stock</th><th>Estado</th><th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($rows)): foreach ($rows as $reg):
                    $productoId = intval($reg['id'] ?? $reg['id_producto'] ?? 0);
                ?>
                    <tr>
                        <td>#<?= $productoId ?></td>
                        <td><?= htmlspecialchars($reg['proveedor']     ?? 'Sin proveedor', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($reg['nombreproducto'] ?? '',              ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($reg['tipo']          ?? '',              ENT_QUOTES) ?></td>
                        <td>Bs. <?= number_format($reg['precio'] ?? 0, 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($reg['stock']  ?? 0, ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($reg['estado'] ?? '', ENT_QUOTES) ?></td>
                        <td>
                            <?php if (!empty($reg['imagen']) && file_exists(__DIR__ . '/../img/' . $reg['imagen'])): ?>
                                <img src="../img/<?= htmlspecialchars($reg['imagen'], ENT_QUOTES) ?>" class="producto-img" alt="Imagen">
                            <?php else: ?>
                                <span style="color:#94a3b8">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="8" class="text-center text-muted py-3">No hay registros</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}

