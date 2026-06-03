<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body { background: linear-gradient(135deg, #d9f4ff, #ffffff, #cceeff); font-family: 'Segoe UI', sans-serif; min-height: 100vh; }
        .panel { background: white; padding: 40px; border-radius: 18px; box-shadow: 0 15px 40px rgba(0,0,0,.15); margin-top: 60px; transition: .4s; }
        .panel:hover { transform: translateY(-5px); }
        h1 { font-weight: 700; color: #0099cc; margin-bottom: 25px; }
        .form-control { border-radius: 25px; border: 2px solid #cceeff; padding: 10px 18px; }
        .form-control:focus { border-color: #0099cc; box-shadow: 0 0 10px rgba(0,153,204,.3); }
        .btn { border-radius: 25px; padding: 8px 20px; margin-right: 5px; transition: .3s; }
        .btn-primary { background: linear-gradient(135deg, #00bfff, #0099cc); border: none; }
        .btn-primary:hover { transform: scale(1.05); box-shadow: 0 10px 20px rgba(0,0,0,.2); }
        .table { margin-top: 25px; border-radius: 10px; overflow: hidden; }
        .table thead { background: #0099cc; color: white; }
        .table tbody tr:hover { background: #e6f7ff; }
        .badge-precio { background: #c7d2fe; color: #3730a3; }
        .badge-stock { background: #d1fae5; color: #047857; }
    </style>
</head>
<body class="app-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="panel animate__animated animate__fadeInUp">
                    <h1 class="text-center"><i class="fas fa-search"></i> Buscar Productos</h1>

                    <form method="GET" class="mb-3">
                        <label><i class="fas fa-boxes"></i> Nombre del producto:</label>
                        <input type="text" name="nombre" class="form-control mb-3" placeholder="Buscar por nombre" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre'], ENT_QUOTES) : '' ?>">

                        <input type="submit" value="Buscar Producto" class="btn btn-primary">
                        <a href="../controller/productoLista.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover text-center mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Proveedor</th>
                                    <th>Producto</th>
                                    <th>Tipo</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($res)): ?>
                                    <?php foreach ($res as $r): ?>
                                        <tr>
                                            <td><?= intval($r['id_producto']) ?></td>
                                            <td><?= htmlspecialchars($r['proveedor'], ENT_QUOTES) ?></td>
                                            <td><?= htmlspecialchars($r['nombreproducto'], ENT_QUOTES) ?></td>
                                            <td><?= htmlspecialchars($r['tipo'], ENT_QUOTES) ?></td>
                                            <td><span class="badge badge-precio">Bs. <?= number_format($r['precio'], 2, ',', '.') ?></span></td>
                                            <td><span class="badge badge-stock"><?= htmlspecialchars($r['stock'], ENT_QUOTES) ?></span></td>
                                            <td><?= htmlspecialchars($r['estado'], ENT_QUOTES) ?></td>
                                            <td><a href="productoModifica.php?cod=<?= intval($r['id_producto']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Modificar</a></td>
                                            <td><a href="productoEliminar.php?cod=<?= intval($r['id_producto']) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No se encontraron productos.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div> </div>
            </div>
        </div>
    </div>
</body>
</html>
