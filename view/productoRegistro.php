<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Producto</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f9ff;
            background-image: linear-gradient(rgba(240, 249, 255, 0.8), rgba(186, 230, 253, 0.6)),
                url('https://images.unsplash.com/photo-1550684376-efcbd6e3f031?q=80&w=2500&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
            margin: 0;
        }

        .pagina {
            max-width: 600px;
            width: 100%;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(12, 74, 110, 0.12);
            padding: 3rem;
        }

        .encabezado { text-align: center; margin-bottom: 2rem; }
        .encabezado-titulo { font-size: 1.85rem; font-weight: 800; color: #0c4a6e; }
        .encabezado-sub { font-size: 0.9rem; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.5rem; }

        .form-group { margin-bottom: 1.3rem; }
        .form-label { display: block; font-weight: 600; color: #334155; margin-bottom: 0.5rem; }
        .form-control {
            width: 100%;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.8);
            transition: 0.2s;
            color: #0f172a;
        }
        .form-control:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
            background: #fff;
        }

        .acciones { display: flex; flex-direction: column; gap: 1rem; margin-top: 2rem; }
        .btn-guardar, .btn-volver {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-guardar { background: #0ea5e9; color: white; }
        .btn-guardar:hover { background: #0284c7; transform: translateY(-1px); }
        .btn-volver { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .btn-volver:hover { background: #e2e8f0; transform: translateY(-1px); }

        .footer-creditos { text-align: center; margin-top: 2rem; font-size: 0.85rem; color: #64748b; }
    </style>
</head>

<body class="app-bg">
<div class="pagina">
    <div class="encabezado">
        <div class="encabezado-titulo"><i class="bi bi-box-seam me-2"></i>Nuevo Producto</div>
        <div class="encabezado-sub">Registra tus productos con el nuevo esquema</div>
    </div>

    <form method="post" action="../controller/productoRegistro.php" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label" for="id_proveedor"><i class="bi bi-truck me-1 text-secondary"></i> Proveedor</label>
            <select id="id_proveedor" name="id_proveedor" class="form-control" required>
                <option value="">Selecciona un proveedor</option>
                <?php foreach (isset($proveedores) ? $proveedores : [] as $p): ?>
                    <option value="<?= intval($p['id_proveedor']) ?>"><?= htmlspecialchars($p['empresa'], ENT_QUOTES) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="nombreproducto"><i class="bi bi-tag me-1 text-secondary"></i> Nombre del producto</label>
            <input type="text" id="nombreproducto" name="nombreproducto" class="form-control" placeholder="Nombre del producto" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="descripcion"><i class="bi bi-card-text me-1 text-secondary"></i> Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="3" placeholder="Descripción breve"></textarea>
        </div>

        <div class="form-group">
            <label class="form-label" for="tipo"><i class="bi bi-tags me-1 text-secondary"></i> Tipo</label>
            <input type="text" id="tipo" name="tipo" class="form-control" placeholder="Ej: camisa, pantalón, accesorio">
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="precio"><i class="bi bi-cash-stack me-1 text-secondary"></i> Precio</label>
                    <input type="number" id="precio" name="precio" class="form-control" placeholder="0.00" step="0.01" min="0" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="stock"><i class="bi bi-boxes me-1 text-secondary"></i> Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control" placeholder="Cantidad disponible" min="0" required>
                </div>
            </div>
        </div>

        <input type="hidden" name="estado" value="Activo">

        <div class="form-group">
            <label class="form-label" for="imagen"><i class="bi bi-image me-1 text-secondary"></i> Imagen</label>
            <input type="file" id="imagen" name="imagen" class="form-control" accept="image/jpeg,image/png,image/webp">
        </div>

        <div class="acciones">
            <button type="submit" name="registrarProducto" class="btn-guardar"><i class="bi bi-save me-2"></i>Registrar Producto</button>
            <a href="../controller/productoLista.php" class="btn-volver"><i class="bi bi-arrow-left me-2"></i>Volver</a>
        </div>
    </form>

    <div class="footer-creditos">Sistema de Productos © 2026</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
