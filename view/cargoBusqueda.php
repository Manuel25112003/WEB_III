<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargos</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body {
            background: linear-gradient(135deg, #d9f4ff, #ffffff, #cceeff);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        .panel {
            background: white;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            margin-top: 60px;
            transition: .4s;
        }

        .panel:hover {
            transform: translateY(-5px);
        }

        h1 {
            font-weight: 700;
            color: #0099cc;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 25px;
            border: 2px solid #cceeff;
            padding: 10px 18px;
        }

        .form-control:focus {
            border-color: #0099cc;
            box-shadow: 0 0 10px rgba(0, 153, 204, .3);
        }

        .btn {
            border-radius: 25px;
            padding: 8px 20px;
            margin-right: 5px;
            transition: .3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00bfff, #0099cc);
            border: none;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .2);
        }

        .btn-warning:hover,
        .btn-secondary:hover {
            transform: scale(1.05);
        }

        .table {
            margin-top: 25px;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background: #0099cc;
            color: white;
        }

        .table tbody tr:hover {
            background: #e6f7ff;
        }
    </style>
    <link rel="stylesheet" href="css/base.css">


<body class="app-bg">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="panel animate__animated animate__fadeInUp">

                    <h1 class="text-center">
                        <i class="fas fa-briefcase"></i> Cargos
                    </h1>

                    <!-- BUSCADOR -->
                    <form method="GET" class="mb-3">
                        <label><i class="fas fa-search"></i> Nombre del Cargo:</label>
                        <input type="text" name="cargo" class="form-control mb-3"
                            value="<?php echo isset($_GET['cargo']) ? htmlspecialchars($_GET['cargo'], ENT_QUOTES) : ''; ?>">

                        <input type="submit" name="Buscar" value="Buscar Cargo" class="btn btn-primary">
                        <button type="reset" class="btn btn-warning"><i class="fas fa-broom"></i> Limpiar</button>
                        <a href="../controller/cargoLista.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                    </form>

                    <!-- TABLA DE CARGOS -->
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th><i class="fas fa-id-badge"></i> ID Cargo</th>
                                <th><i class="fas fa-briefcase"></i> Cargo</th>
                                <th class="text-primary"><i class="fas fa-edit"></i> Modificar</th>
                                <th class="text-danger"><i class="fas fa-trash"></i> Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($res)): ?>
                                <?php foreach ($res as $r): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($r['id_cargo'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($r['cargo'], ENT_QUOTES); ?></td>
                                        <td>
                                            <a href="cargoModifica.php?cod=<?php echo $r['id_cargo']; ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Modificar
                                            </a>
                                        </td>
                                        <td>
                                            <a href="cargoEliminar.php?cod=<?php echo $r['id_cargo']; ?>"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">No se encontraron cargos.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</body>

</html>