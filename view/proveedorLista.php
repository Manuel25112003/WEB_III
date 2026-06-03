<?php
/*
 * Panel de Proveedores
 * Con fondo de imagen y efecto Glassmorphism
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Proveedores</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { 
            /* Fondo con imagen y degradado azul claro */
            background-color: #f0f9ff;
            background-image: 
                linear-gradient(rgba(240, 249, 255, 0.8), rgba(186, 230, 253, 0.6)), 
                url('https://images.unsplash.com/photo-1550684376-efcbd6e3f031?q=80&w=2500&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            
            font-family: 'Inter', sans-serif; 
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 3rem 1rem;
            margin: 0;
        }

        /* Panel Principal (Efecto cristal) */
        .pagina { 
            max-width: 1400px; 
            width: 100%;
            background: rgba(255, 255, 255, 0.90); /* Ligeramente más opaco para leer bien la tabla */
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(12, 74, 110, 0.1);
            padding: 3rem; 
        }

        .encabezado { 
            border-bottom: 2px solid var(--txt-oscuro, #0c4a6e); 
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .encabezado-titulo { font-size: 1.8rem; font-weight: 800; color: var(--txt-oscuro, #0c4a6e); }
        .encabezado-sub { font-size: 0.9rem; color: var(--txt-claro, #64748b); text-transform: uppercase; letter-spacing: 1px; }
        
        .tabla-proveedores {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid var(--bg-borde, #e2e8f0);
            margin-bottom: 2rem;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .tabla-proveedores thead tr {
            background: var(--bg-borde, #f8fafc);
            color: var(--txt-oscuro, #0f172a);
        }
        .tabla-proveedores th {
            padding: .85rem 1rem;
            font-size: .70rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            text-align: left;
            white-space: nowrap;
        }
        .tabla-proveedores tbody tr {
            background: var(--bg-card, #ffffff);
            border-bottom: 1px solid var(--bg-borde, #e2e8f0);
            transition: background .15s;
        }
        .tabla-proveedores tbody tr:hover {
            background: var(--bg-borde, #f1f5f9);
        }
        .tabla-proveedores td {
            padding: .75rem 1rem;
            font-size: .88rem;
            vertical-align: middle;
            color: var(--txt-medio, #334155);
        }
        .tabla-proveedores td.td-acciones {
            white-space: nowrap;
        }
        .tabla-scroll {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .contador { font-weight: 600; font-size: 0.9rem; margin-bottom: 1rem; color: var(--txt-claro, #64748b); }
        .etiqueta { background: #f8fafc; color: #334155; padding: 0.2rem 0.6rem; border-radius: 6px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0; }
        
        .logo-prov {
            width: 40px;
            height: 40px;
            object-fit: contain;
            background: #fff;
            padding: 2px;
            border-radius: 6px;
            border: 1px solid var(--bg-borde, #e2e8f0);
        }

        /* Botones unificados */
        .btn-nuevo, .btn-buscar, .btn-salir, .btn-editar, .btn-eliminar {
            display: inline-flex; align-items: center; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 600; transition: all 0.2s; border: none; cursor: pointer;
        }
        .btn-nuevo { background: #10b981; color: white; }
        .btn-nuevo:hover { background: #059669; color: white; transform: translateY(-1px); }
        
        .btn-buscar { background: #0ea5e9; color: white; }
        .btn-buscar:hover { background: #0284c7; color: white; transform: translateY(-1px); }
        
        .btn-salir { background: #ef4444; color: white; }
        .btn-salir:hover { background: #dc2626; color: white; transform: translateY(-1px); }
        
        .btn-editar { background: #f8fafc; color: #0ea5e9; border: 1px solid #bae6fd; margin-right: 0.5rem; }
        .btn-editar:hover { background: #e0f2fe; color: #0284c7; }
        
        .btn-eliminar { background: #fdf2f8; color: #e11d48; border: 1px solid #fbcfe8; }
        .btn-eliminar:hover { background: #ffe4e6; color: #be123c; }

        .footer-creditos { text-align: center; margin-top: 3rem; font-size: 0.85rem; color: var(--txt-claro, #64748b); font-weight: 600; }

        @media (max-width: 768px) {
            .pagina { padding: 1.5rem; border-radius: 16px; }
            .encabezado { flex-direction: column; align-items: flex-start; }
        }
    </style>
    <link rel="stylesheet" href="css/base.css">

<body class="app-bg">
<div class="pagina">

    <div class="encabezado">
        <div>
            <div class="encabezado-titulo"><i class="bi bi-truck me-2"></i>Panel de Proveedores</div>
            <div class="encabezado-sub">Gestión de Proveedores</div>
        </div>
        <div style="display:flex; gap:.6rem; align-items:center; flex-wrap: wrap;">
            <a href="../controller/proveedorRegistro.php" class="btn-nuevo">
                <i class="bi bi-plus-circle-dotted me-1"></i>Nuevo Proveedor
            </a>
            <a href="../controller/proveedorBusqueda.php" class="btn-buscar">
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
            <h4 style="color: #334155; font-weight: 700;">No existen proveedores</h4>
            <p style="color: #64748b;">Aún no hay registros en la base de datos.</p>
            <a href="../controller/proveedorRegistro.php" class="btn-nuevo mt-2"><i class="bi bi-plus-lg me-1"></i>Agregar el primero</a>
        </div>
    <?php else: ?>
        <div class="contador">Mostrando <?= count($resultado) ?> proveedor<?= count($resultado) != 1 ? 'es' : '' ?></div>

        <div class="tabla-scroll">
            <table class="tabla-proveedores">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Empresa</th>
                        <th>Contacto</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Logo</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $i => $reg): ?>
                    <tr>
                        <td style="text-align:center; color:var(--txt-claro); font-weight:700;">#<?= $reg['id_proveedor'] ?></td>
                        <td style="font-weight:600; color: #0f172a;"><?= htmlspecialchars($reg['empresa']) ?></td>
                        <td><?= htmlspecialchars($reg['contacto']) ?></td>
                        <td><?= htmlspecialchars($reg['mail']) ?></td>
                        <td><span class="etiqueta"><?= $reg['telefono'] ?></span></td>
                        <td>
                            <?php if (!empty($reg['logo']) && file_exists("../img/" . $reg['logo'])): ?>
                                <img src="../img/<?= $reg['logo'] ?>" class="logo-prov" alt="Logo">
                            <?php else: ?>
                                <i class="bi bi-image text-muted fs-5"></i>
                            <?php endif; ?>
                        </td>
                        <td class="td-acciones">
                            <a href="../controller/proveedorModifica.php?cod=<?= $reg['id_proveedor'] ?>" class="btn-editar">
                                <i class="bi bi-pencil-square me-1"></i>Modificar
                            </a>
                            <a href="javascript:void(0)" onclick="confirmarEliminar(<?= $reg['id_proveedor'] ?>)" class="btn-eliminar">
                                <i class="bi bi-trash3-fill me-1"></i>Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="footer-creditos">
        <i class="bi bi-shield-check me-1"></i> Manuel Condori Linares &copy; 2026
    </div>

</div>

<script>
    function confirmarEliminar(id) {
        Swal.fire({
            title: '¿Eliminar proveedor?',
            text: "Esta acción borrará al proveedor #" + id + " de forma permanente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../controller/proveedorEliminar.php?cod=" + id;
            }
        })
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>