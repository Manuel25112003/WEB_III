<?php
/*
 * Panel de Productos
 * Basado en el estilo de clientes y con operaciones completas
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Productos</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { 
            background-color: #f0f9ff;
            background-image: linear-gradient(rgba(240, 249, 255, 0.88), rgba(186, 230, 253, 0.6)),
                url('https://images.unsplash.com/photo-1550684376-efcbd6e3f031?q=80&w=2500&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 3rem 1rem;
            margin: 0;
        }

        .pagina {
            width: 100%;
            max-width: 1300px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            box-shadow: 0 18px 45px rgba(12, 74, 110, 0.12);
            padding: 3rem;
        }

        .encabezado {
            border-bottom: 2px solid #0c4a6e;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .encabezado-titulo { font-size: 1.8rem; font-weight: 800; color: #0c4a6e; }
        .encabezado-sub { font-size: 0.9rem; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }

        .tabla-productos {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e2e8f0;
            margin-bottom: 2rem;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .tabla-productos thead tr { background: #f8fafc; color: #0f172a; }
        .tabla-productos th {
            padding: .85rem 1rem;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            text-align: left;
            white-space: nowrap;
        }

        .tabla-productos tbody tr {
            transition: background .15s;
            border-bottom: 1px solid #e2e8f0;
        }

        .tabla-productos tbody tr:hover { background: #f1f5f9; }
        .tabla-productos td {
            padding: .75rem 1rem;
            vertical-align: middle;
            font-size: .9rem;
            color: #334155;
        }

        .tabla-productos td.td-acciones { white-space: nowrap; }
        .producto-img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .badge-precio { background: #c7d2fe; color: #3730a3; font-weight: 700; }
        .badge-stock { background: #d1fae5; color: #047857; font-weight: 700; }

        .btn-nuevo, .btn-buscar, .btn-salir, .btn-editar, .btn-eliminar, .btn-reporte {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: .9rem;
            font-weight: 600;
            transition: all .2s;
            border: none;
            cursor: pointer;
        }

        .btn-nuevo { background: #10b981; color: white; }
        .btn-nuevo:hover { background: #059669; transform: translateY(-1px); }

        .btn-buscar { background: #0ea5e9; color: white; }
        .btn-buscar:hover { background: #0284c7; transform: translateY(-1px); }

        .btn-inactivos { background: #f59e0b; color: white; }
        .btn-inactivos:hover { background: #d97706; transform: translateY(-1px); }

        .btn-reporte { background: #f59e0b; color: white; }
        .btn-reporte:hover { background: #d97706; transform: translateY(-1px); }

        .btn-salir { background: #ef4444; color: white; }
        .btn-salir:hover { background: #dc2626; transform: translateY(-1px); }

        .btn-editar { background: #f8fafc; color: #0ea5e9; border: 1px solid #bae6fd; margin-right: .5rem; }
        .btn-editar:hover { background: #e0f2fe; color: #0284c7; }

        .btn-eliminar { background: #fdf2f8; color: #e11d48; border: 1px solid #fbcfe8; }
        .btn-eliminar:hover { background: #ffe4e6; color: #be123c; }

        .contador { font-weight: 600; font-size: .95rem; margin-bottom: 1rem; color: #64748b; }
        .footer-creditos { text-align: center; margin-top: 2rem; font-size: .85rem; color: #64748b; }

        .tabla-scroll { overflow-x: auto; border-radius: 10px; box-shadow: 0 6px 10px rgba(15, 23, 42, .05); }

        @media (max-width: 768px) { .pagina { padding: 2rem; border-radius: 20px; } }
    </style>
    <link rel="stylesheet" href="css/base.css">
</head>

<body class="app-bg">
<div class="pagina">

    <div class="encabezado">
        <div>
            <div class="encabezado-titulo"><i class="bi bi-cart me-2"></i>Panel de Productos</div>
            <div class="encabezado-sub">Gestión de Productos</div>
        </div>
        <div style="display:flex; gap:.6rem; align-items:center; flex-wrap: wrap;">
            <a href="../controller/productoRegistro.php" class="btn-nuevo">
                <i class="bi bi-plus-circle-dotted me-1"></i>Nuevo Producto
            </a>
            <a href="../controller/productoReporte.php" class="btn-reporte">
                <i class="bi bi-file-earmark-text me-1"></i>Reporte
            </a>
            <a href="../controller/productoBusqueda.php" class="btn-buscar">
                <i class="bi bi-search me-1"></i>Buscar
            </a>
            <a href="../index.php" class="btn-salir">
                <i class="bi bi-box-arrow-right me-1"></i>Salir
            </a>
        </div>
    </div>

    <?php if (empty($resultado) || count($resultado) == 0): ?>
        <div class="vacio" style="text-align: center; padding: 4rem 2rem; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
            <div class="vacio-icono" style="font-size: 3rem; color: #94a3b8; margin-bottom: 1rem;"><i class="bi bi-info-circle"></i></div>
            <h4 style="color: #334155; font-weight: 700;">No hay productos registrados</h4>
            <p style="color: #64748b;">Agrega el primer producto para comenzar con la gestión.</p>
            <a href="../controller/productoRegistro.php" class="btn-nuevo mt-2"><i class="bi bi-plus-lg me-1"></i>Agregar producto</a>
        </div>
    <?php else: ?>
        <div class="contador">Mostrando <?= count($resultado) ?> producto<?= count($resultado) != 1 ? 's' : '' ?></div>

        <div class="tabla-scroll">
            <table class="tabla-productos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Proveedor</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $reg):
                        $productoId = intval($reg['id'] ?? $reg['id_producto'] ?? 0);
                    ?>
                    <tr>
                        <td style="text-align:center; color:#475569; font-weight:700;">#<?= $productoId ?></td>
                        <td><?= htmlspecialchars($reg['proveedor'] ?? 'Sin proveedor', ENT_QUOTES) ?></td>
                        <td style="font-weight:600; color: #0f172a;"><?= htmlspecialchars($reg['nombreproducto'], ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($reg['tipo'], ENT_QUOTES) ?></td>
                        <td><span class="badge badge-precio">Bs. <?= number_format($reg['precio'], 2, ',', '.') ?></span></td>
                        <td><span class="badge badge-stock"><?= htmlspecialchars($reg['stock'], ENT_QUOTES) ?></span></td>
                        <td><?= htmlspecialchars($reg['estado'], ENT_QUOTES) ?></td>
                        <td>
                            <?php if (!empty($reg['imagen']) && file_exists("../img/" . $reg['imagen'])): ?>
                                <img src="../img/<?= htmlspecialchars($reg['imagen'], ENT_QUOTES) ?>" class="producto-img" alt="Imagen producto">
                            <?php else: ?>
                                <i class="bi bi-box-seam text-muted fs-4"></i>
                            <?php endif; ?>
                        </td>
                        <td class="td-acciones">
                            <a href="../controller/productoModifica.php?cod=<?= $productoId ?>" class="btn-editar">
                                <i class="bi bi-pencil-square me-1"></i>Modificar
                            </a>
                            <a href="../controller/productoInactiva.php?cod=<?= $productoId ?>" class="btn-eliminar"
                               onclick="return confirm('¿Inactivar el producto #<?= $productoId ?>?');">
                                <i class="bi bi-person-x-fill me-1"></i>Inactivar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="footer-creditos">
        <i class="bi bi-code-slash me-1"></i> Manuel Condori Linares &copy; 2026
    </div>

</div>

<script>
    function confirmarInactivar(id) {
        Swal.fire({
            title: '¿Inactivar producto?',
            text: "Esta acción pondrá el producto #" + id + " como inactivo.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, inactivar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../controller/productoInactiva.php?cod=" + id;
            }
        })
    }
</script>
<!-- El botón abre la página del reporte en una nueva pestaña -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
