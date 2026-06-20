<?php
/* Página de Catálogo de Productos en tarjetas */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #f8fafc 0%, #e0f2fe 60%, #e0f2fe 100%);
            color: #334155;
        }

        .catalogo-contenedor {
            max-width: 1300px;
            margin: 0 auto;
            padding: 2rem 1rem 4rem;
        }

        .catalogo-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .catalogo-title {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .catalogo-title h1 {
            margin: 0;
            font-size: 2.2rem;
            font-weight: 800;
            color: #0f172a;
        }

        .catalogo-title p {
            margin: 0;
            color: #64748b;
            font-size: 0.95rem;
        }

        .btn-volver,
        .btn-lista {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.85rem 1.2rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-volver {
            background: #0ea5e9;
            color: #ffffff;
        }

        .btn-lista {
            background: #10b981;
            color: #ffffff;
        }

        .btn-volver:hover,
        .btn-lista:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(14, 165, 233, 0.18);
        }

        .catalogo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .producto-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
            border: 1px solid rgba(148, 163, 184, 0.18);
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .producto-imagen {
            width: 100%;
            min-height: 210px;
            border-radius: 20px;
            object-fit: cover;
            background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
        }

        .producto-detalle {
            margin-top: 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
            flex: 1;
        }

        .producto-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
        }

        .badge-categoria {
            border-radius: 999px;
            padding: 0.35rem 0.8rem;
            font-size: 0.76rem;
            font-weight: 700;
            color: #ffffff;
            background: #312e81;
        }

        .badge-stock {
            border-radius: 999px;
            padding: 0.35rem 0.8rem;
            font-size: 0.76rem;
            font-weight: 700;
            background: #d1fae5;
            color: #047857;
        }

        .producto-nombre {
            margin: 0;
            font-size: 1.28rem;
            font-weight: 800;
            color: #0f172a;
        }

        .producto-info {
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.55;
        }

        .producto-descripcion {
            color: #475569;
            font-size: 0.95rem;
            min-height: 4rem;
        }

        .producto-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-top: auto;
            flex-wrap: wrap;
        }

        .precio {
            font-size: 1.2rem;
            font-weight: 800;
            color: #0f172a;
        }

        .proveedor {
            color: #64748b;
            font-size: 0.9rem;
        }

        .catalogo-mensaje {
            text-align: center;
            padding: 3rem 1.5rem;
            background: #ffffff;
            border: 1px dashed #cbd5e1;
            border-radius: 20px;
            color: #334155;
        }

        .catalogo-mensaje i {
            font-size: 2.5rem;
            color: #0ea5e9;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .catalogo-header { flex-direction: column; align-items: stretch; }
            .producto-footer { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="catalogo-contenedor">
        <div class="catalogo-header">
            <div class="catalogo-title">
                <h1><i class="bi bi-grid-3x3-gap-fill"></i> Catálogo de Productos</h1>
                <p>Visualiza los productos activos en tarjetas atractivas con precio, stock y proveedor.</p>
            </div>
            <div style="display:flex; gap: 0.8rem; flex-wrap: wrap;">
                <a href="../index.php" class="btn-volver"><i class="bi bi-house-door-fill"></i> Inicio</a>
                <a href="productoLista.php" class="btn-lista"><i class="bi bi-list-ul"></i> Ver lista</a>
            </div>
        </div>

        <?php if (empty($resultado) || count($resultado) === 0): ?>
            <div class="catalogo-mensaje">
                <i class="bi bi-box-seam"></i>
                <h2>No hay productos disponibles</h2>
                <p>Por el momento no hay productos activos para mostrar en el catálogo. Agrega productos desde la administración.</p>
            </div>
        <?php else: ?>
            <div class="catalogo-grid">
                <?php foreach ($resultado as $producto): ?>
                    <article class="producto-card">
                        <?php if (!empty($producto['imagen']) && file_exists("../img/" . $producto['imagen'])): ?>
                            <img src="../img/<?= htmlspecialchars($producto['imagen'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($producto['nombreproducto'], ENT_QUOTES) ?>" class="producto-imagen">
                        <?php else: ?>
                            <div class="producto-imagen d-flex align-items-center justify-content-center text-secondary">
                                <i class="bi bi-image-fill fs-1"></i>
                            </div>
                        <?php endif; ?>

                        <div class="producto-detalle">
                            <div class="producto-badges">
                                <span class="badge-categoria"><?= htmlspecialchars($producto['tipo'] ?: 'General', ENT_QUOTES) ?></span>
                                <span class="badge-stock"><?= intval($producto['stock']) ?> en stock</span>
                            </div>

                            <h2 class="producto-nombre"><?= htmlspecialchars($producto['nombreproducto'], ENT_QUOTES) ?></h2>
                            <p class="producto-info">Proveedor: <strong><?= htmlspecialchars($producto['proveedor'] ?: 'Sin proveedor', ENT_QUOTES) ?></strong></p>
                            <p class="producto-descripcion"><?= nl2br(htmlspecialchars($producto['descripcion'] ?: 'Sin descripción disponible.', ENT_QUOTES)) ?></p>

                            <div class="producto-footer">
                                <span class="precio">Bs. <?= number_format($producto['precio'], 2, ',', '.') ?></span>
                                <span class="proveedor">Estado: <?= htmlspecialchars($producto['estado'], ENT_QUOTES) ?></span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
