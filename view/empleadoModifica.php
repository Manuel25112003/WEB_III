<?php
/*
 * vista/empleadoModifica.php — Formulario de edición de empleado
 * Diseño en una sola columna con estilo Glassmorphism.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Empleado · Sistema</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-fondo: #f0f9ff;
            --bg-borde: #e0f2fe;
            --txt-oscuro: #0c4a6e;
            --txt-medio: #334155;
            --txt-claro: #64748b;
            --accent: #0ea5e9;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            background-color: var(--bg-fondo);
            background-image: 
                linear-gradient(rgba(240, 249, 255, 0.8), rgba(186, 230, 253, 0.6)), 
                url('https://images.unsplash.com/photo-1550684376-efcbd6e3f031?q=80&w=2500&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: var(--txt-medio);
        }

        .panel-modificar {
            width: 100%;
            max-width: 550px; /* Reducido para que la columna única no se vea estirada */
            background: rgba(255, 255, 255, 0.9);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(12, 74, 110, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            padding: 2rem;
        }

        .panel-header {
            text-align: center;
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--bg-borde);
            padding-bottom: 1.5rem;
        }

        .panel-header h2 {
            color: var(--txt-oscuro);
            font-weight: 800;
            margin: 0;
            font-size: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--txt-oscuro);
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-control, .form-select {
            border: 1px solid var(--bg-borde);
            border-radius: 10px;
            padding: 0.6rem 1rem;
            transition: all 0.2s;
            background-color: rgba(255, 255, 255, 0.5);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            background-color: #fff;
            outline: none;
        }

        .intereses-box {
            background: var(--bg-fondo);
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid var(--bg-borde);
        }

        .btn-update {
            width: 100%;
            padding: 0.8rem;
            border-radius: 10px;
            font-weight: 700;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(245, 158, 11, 0.3);
        }

        .btn-back {
            display: block;
            text-align: center;
            width: 100%;
            padding: 0.7rem;
            background: #fff;
            color: var(--txt-claro);
            border: 1px solid var(--bg-borde);
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 0.8rem;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: #f8fafc;
            color: var(--txt-medio);
        }
    </style>
    <link rel="stylesheet" href="css/base.css">

<body class="app-bg">

<div class="panel-modificar">
    <div class="panel-header">
        <h2><i class="bi bi-pencil-square text-warning me-2"></i>Modificar Empleado</h2>
    </div>

    <form method="post">
        <?php if (isset($resultado) && is_array($resultado) && count($resultado) > 0): ?>
            <?php foreach ($resultado as $reg): 
                $intereses_db = !empty($reg['intereses']) ? explode(", ", $reg['intereses']) : [];
            ?>
            <input type="hidden" name="cod" value="<?= htmlspecialchars($reg['id_empleado']) ?>">

            <div class="row">
                <!-- CARGO (Ahora col-12 para una sola columna) -->
                <div class="col-12 mb-3">
                    <label class="form-label"><i class="bi bi-briefcase"></i> Cargo</label>
                    <select name="idcargo" class="form-select" required>
                        <option value="">Seleccione</option>
                        <?php
                        $cargos_list = [
                            1 => "Administrador", 2 => "Gerente General", 3 => "Subgerente",
                            4 => "Contador", 5 => "Supervisor", 6 => "Secretaria",
                            7 => "Recepcionista", 8 => "Vendedor", 9 => "Técnico de Sistemas",
                            10 => "Soporte Técnico"
                        ];
                        foreach ($cargos_list as $id => $nombre) {
                            $selected = ($reg['id_cargo'] == $id) ? "selected" : "";
                            echo "<option value='$id' $selected>$nombre</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- CI -->
                <div class="col-12 mb-3">
                    <label class="form-label"><i class="bi bi-card-text"></i> CI</label>
                    <input type="text" name="ci" class="form-control" value="<?= htmlspecialchars($reg['ci']) ?>" required>
                </div>

                <!-- NOMBRE -->
                <div class="col-12 mb-3">
                    <label class="form-label"><i class="bi bi-person"></i> Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($reg['nombre']) ?>" required>
                </div>

                <!-- PATERNO -->
                <div class="col-12 mb-3">
                    <label class="form-label">Apellido Paterno</label>
                    <input type="text" name="paterno" class="form-control" value="<?= htmlspecialchars($reg['paterno']) ?>" required>
                </div>

                <!-- MATERNO -->
                <div class="col-12 mb-3">
                    <label class="form-label">Apellido Materno</label>
                    <input type="text" name="materno" class="form-control" value="<?= htmlspecialchars($reg['materno']) ?>">
                </div>

                <!-- DIRECCION -->
                <div class="col-12 mb-3">
                    <label class="form-label"><i class="bi bi-geo-alt"></i> Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="<?= htmlspecialchars($reg['direccion']) ?>">
                </div>

                <!-- TELEFONO -->
                <div class="col-12 mb-3">
                    <label class="form-label"><i class="bi bi-telephone"></i> Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($reg['telefono']) ?>">
                </div>

                <!-- FECHA NACIMIENTO -->
                <div class="col-12 mb-3">
                    <label class="form-label"><i class="bi bi-calendar-event"></i> Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" value="<?= $reg['fechanacimiento'] ?>">
                </div>

                <!-- GENERO -->
                <div class="col-12 mb-3">
                    <label class="form-label"><i class="bi bi-gender-ambiguous"></i> Género</label>
                    <select name="genero" class="form-select">
                        <option value="">Seleccione</option>
                        <option value="M" <?= $reg['genero'] == "M" ? "selected" : "" ?>>Masculino</option>
                        <option value="F" <?= $reg['genero'] == "F" ? "selected" : "" ?>>Femenino</option>
                    </select>
                </div>

                <!-- INTERESES -->
                <div class="col-12 mb-4">
                    <label class="form-label"><i class="bi bi-stars"></i> Intereses</label>
                    <div class="intereses-box">
                        <div class="row g-2">
                            <?php
                            $opciones = ["Deportes", "Música", "Lectura", "Viajes", "Tecnología"];
                            foreach ($opciones as $opc) {
                                $checked = in_array($opc, $intereses_db) ? "checked" : "";
                                echo "
                                <div class='col-6'>
                                    <div class='form-check'>
                                        <input type='checkbox' name='intereses[]' value='$opc' id='check_$opc' class='form-check-input' $checked>
                                        <label class='form-check-label' for='check_$opc' style='font-size: 0.85rem;'>$opc</label>
                                    </div>
                                </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-danger text-center">No se encontraron datos.</div>
        <?php endif; ?>

        <button type="submit" name="modificarEmpleado" class="btn-update">
            <i class="bi bi-save2 me-2"></i>Guardar Cambios
        </button>
        
        <a href="../controller/empleadoLista.php" class="btn-back">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>