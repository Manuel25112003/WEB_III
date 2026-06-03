<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body { background: #e2effa; font-family: 'Inter', sans-serif; }
        .card { border-radius: 24px; }
        .card-header { border-top-left-radius: 24px; border-top-right-radius: 24px; }
        .form-control { border-radius: 14px; }
        .btn { border-radius: 999px; }
        .imagen-preview { width: 100px; height: 100px; object-fit: cover; border-radius: 16px; border: 1px solid #cbd5e1; }
    </style>
</head>
<body class="bg-info-subtle app-bg">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 animate__animated animate__fadeIn">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h3 class="fw-bold mb-0"><i class="fa-solid fa-boxes-stacked me-2"></i> Editar Producto</h3>
                    <small class="text-light">Actualiza los datos del producto</small>
                </div>
                <div class="card-body bg-white p-4">
                    <?php if (isset($res) && count($res) > 0):
                        $reg = $res[0];
                    ?>
                        <form method="post" action="../controller/productoModifica.php" enctype="multipart/form-data">
                            <input type="hidden" name="cod" value="<?= intval($reg['id_producto']) ?>">

                            <div class="mb-3">
                                <label class="form-label"><i class="fa-solid fa-truck me-1 text-primary"></i> Proveedor</label>
                                <select name="id_proveedor" class="form-select rounded-3 border-primary" required>
                                    <?php foreach (isset($proveedores) ? $proveedores : [] as $p): ?>
                                        <option value="<?= intval($p['id_proveedor']) ?>" <?= intval($p['id_proveedor']) === intval($reg['id_proveedor']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($p['empresa'], ENT_QUOTES) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="nombreproducto" id="nombreproducto" value="<?= htmlspecialchars($reg['nombreproducto'], ENT_QUOTES) ?>" class="form-control rounded-3 border-primary" placeholder="Nombre del producto" required>
                                <label for="nombreproducto"><i class="fa-solid fa-tag me-1 text-primary"></i> Nombre Producto</label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fa-solid fa-file-lines me-1 text-primary"></i> Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control rounded-3 border-primary" rows="3" placeholder="Descripción del producto"><?= htmlspecialchars($reg['descripcion'], ENT_QUOTES) ?></textarea>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" name="precio" id="precio" value="<?= htmlspecialchars($reg['precio'], ENT_QUOTES) ?>" class="form-control rounded-3 border-primary" placeholder="Precio" step="0.01" min="0" required>
                                        <label for="precio"><i class="fa-solid fa-money-bill-wave me-1 text-primary"></i> Precio</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" name="stock" id="stock" value="<?= htmlspecialchars($reg['stock'], ENT_QUOTES) ?>" class="form-control rounded-3 border-primary" placeholder="Stock" min="0" required>
                                        <label for="stock"><i class="fa-solid fa-boxes-stacked me-1 text-primary"></i> Stock</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="tipo" id="tipo" value="<?= htmlspecialchars($reg['tipo'], ENT_QUOTES) ?>" class="form-control rounded-3 border-primary" placeholder="Tipo">
                                        <label for="tipo"><i class="fa-solid fa-tags me-1 text-primary"></i> Tipo</label>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($reg['imagen']) && file_exists(__DIR__ . '/../img/' . $reg['imagen'])): ?>
                                <div class="mb-3 text-center">
                                    <img src="../img/<?= htmlspecialchars($reg['imagen'], ENT_QUOTES) ?>" alt="Imagen actual" class="imagen-preview mb-2">
                                    <p class="small text-secondary">Imagen actual</p>
                                </div>
                            <?php endif; ?>

                            <div class="mb-4">
                                <label class="form-label"><i class="fa-solid fa-image me-1 text-primary"></i> Nueva imagen</label>
                                <input type="file" name="imagen" class="form-control form-control-lg rounded-3" accept="image/jpeg,image/png,image/webp">
                            </div>

                            <div class="d-grid gap-3">
                                <button type="submit" name="modificarProducto" class="btn btn-primary btn-lg">
                                    <i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios
                                </button>
                                <a href="../controller/productoLista.php" class="btn btn-outline-primary btn-lg">
                                    <i class="fa-solid fa-arrow-left me-2"></i> Volver
                                </a>
                            </div>
                        </form>
                    <?php else: ?>
                        <p class="text-center text-muted">No se encontró el producto.</p>
                        <div class="d-grid">
                            <a href="../controller/productoLista.php" class="btn btn-outline-primary btn-lg">
                                <i class="fa-solid fa-arrow-left me-2"></i> Volver a la lista
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer bg-light text-center small text-muted">Sistema de Productos © 2026</div>
            </div>
        </div>
    </div>
</body>
</html>
