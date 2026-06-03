<?php
/*
 * vista/empleadoRegistro.php — Formulario de nuevo registro
 * Estilo visual Glassmorphism en una sola columna.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Empleado · Sistema</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            --bg-fondo: #f0f9ff;
            --bg-borde: #e0f2fe;
            --txt-oscuro: #0c4a6e;
            --txt-medio: #334155;
            --txt-claro: #64748b;
            --accent: #0ea5e9;
            --success: #10b981;
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

        .panel-registro {
            width: 100%;
            max-width: 550px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(12, 74, 110, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            padding: 2.5rem;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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
            padding: 0.7rem 1rem;
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
            padding: 1.2rem;
            border-radius: 15px;
            border: 1px solid var(--bg-borde);
        }

        .btn-register {
            width: 100%;
            padding: 0.9rem;
            border-radius: 12px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .btn-back {
            display: block;
            text-align: center;
            width: 100%;
            padding: 0.7rem;
            background: #fff;
            color: var(--txt-claro);
            border: 1px solid var(--bg-borde);
            border-radius: 12px;
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

        .icon-label {
            color: var(--success);
        }
    </style>
    <link rel="stylesheet" href="css/base.css">

<body class="app-bg">

<div class="panel-registro animate__animated animate__fadeInDown">
    <div class="panel-header">
        <h2 class="animate__animated animate__pulse"><i class="bi bi-person-plus-fill"></i> Registro de Empleado</h2>
    </div>

    <form method="post" class="animate__animated animate__fadeIn">
        <div class="row">
            <!-- CARGO -->
            <div class="col-12 mb-3">
                <label class="form-label"><i class="bi bi-briefcase icon-label"></i> Cargo</label>
                <select name="idcargo" class="form-select" required>
                    <option value="">Seleccione un cargo</option>
                    <?php foreach (isset($cargos) ? $cargos : [] as $cargo): ?>
                        <option value="<?= intval($cargo['id_cargo']) ?>"><?= htmlspecialchars($cargo['cargo'], ENT_QUOTES) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- CI -->
            <div class="col-12 mb-3">
                <label class="form-label"><i class="bi bi-card-text icon-label"></i> CI / Documento</label>
                <input type="text" name="ci" class="form-control" placeholder="Ingrese documento" required>
            </div>

            <!-- NOMBRE -->
            <div class="col-12 mb-3">
                <label class="form-label"><i class="bi bi-person icon-label"></i> Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombres" required>
            </div>

            <!-- PATERNO -->
            <div class="col-12 mb-3">
                <label class="form-label"><i class="bi bi-person-badge icon-label"></i> Apellido Paterno</label>
                <input type="text" name="paterno" class="form-control" placeholder="Primer apellido" required>
            </div>

            <!-- MATERNO -->
            <div class="col-12 mb-3">
                <label class="form-label"><i class="bi bi-person-badge icon-label"></i> Apellido Materno</label>
                <input type="text" name="materno" class="form-control" placeholder="Segundo apellido">
            </div>

            <!-- DIRECCION -->
            <div class="col-12 mb-3">
                <label class="form-label"><i class="bi bi-geo-alt icon-label"></i> Dirección</label>
                <input type="text" name="direccion" class="form-control" placeholder="Domicilio actual">
            </div>

            <!-- TELEFONO -->
            <div class="col-12 mb-3">
                <label class="form-label"><i class="bi bi-telephone icon-label"></i> Teléfono</label>
                <input type="text" name="telefono" class="form-control" placeholder="Número de contacto">
            </div>

            <!-- FECHA -->
            <div class="col-12 mb-3">
                <label class="form-label"><i class="bi bi-calendar-event icon-label"></i> Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control">
            </div>

            <!-- GENERO -->
            <div class="col-12 mb-3">
                <label class="form-label"><i class="bi bi-gender-ambiguous icon-label"></i> Género</label>
                <select name="genero" class="form-select">
                    <option value="">Seleccione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>

            <!-- INTERESES -->
            <div class="col-12 mb-4">
                <label class="form-label"><i class="bi bi-heart-fill icon-label"></i> Intereses</label>
                <div class="intereses-box">
                    <div class="row g-2">
                        <?php $opc = ["Deportes", "Música", "Lectura", "Viajes", "Tecnología"]; 
                        foreach($opc as $item): ?>
                        <div class="col-6">
                            <div class="form-check">
                                <input type="checkbox" name="intereses[]" value="<?= $item ?>" id="check<?= $item ?>" class="form-check-input">
                                <label class="form-check-label" for="check<?= $item ?>" style="font-size: 0.85rem;"><?= $item ?></label>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" name="registrarEmpleado" class="btn-register animate__animated animate__zoomIn">
            <i class="bi bi-cloud-arrow-up-fill me-2"></i> Guardar Registro
        </button>
        
        <a href="../controller/empleadoLista.php" class="btn-back">
            <i class="bi bi-arrow-left me-1"></i> Volver a la lista
        </a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>