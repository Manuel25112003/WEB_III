<?php
/*
 * vista/empleadoBusqueda.php — Buscador de empleados en tiempo real
 * Estilo visual Glassmorphism unificado.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Empleado · Sistema</title>

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
        }

        body {
            background-color: var(--bg-fondo);
            background-image: 
                linear-gradient(rgba(240, 249, 255, 0.8), rgba(186, 230, 253, 0.6)), 
                url('https://images.unsplash.com/photo-1550684376-efcbd6e3f031?q=80&w=2500&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            padding: 2rem 0;
        }

        .panel-busqueda {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(12, 74, 110, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            padding: 2rem;
        }

        .panel-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .panel-header h2 {
            color: var(--txt-oscuro);
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        /* Buscador Estilizado */
        .search-box {
            position: relative;
            max-width: 600px;
            margin: 0 auto 2.5rem;
        }

        .search-box input {
            height: 60px;
            border-radius: 30px;
            padding-left: 55px;
            border: 2px solid var(--bg-borde);
            background: white;
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.05);
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .search-box input:focus {
            border-color: var(--accent);
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.15);
            transform: translateY(-2px);
        }

        .search-box i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.4rem;
            color: var(--accent);
        }

        /* Tabla Estilizada */
        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid var(--bg-borde);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: var(--txt-oscuro);
            color: white;
        }

        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 1rem;
            border: none;
        }

        .table tbody tr {
            background: rgba(255, 255, 255, 0.5);
            transition: all 0.2s;
        }

        .table tbody tr:hover {
            background: #f0f9ff !important;
        }

        .table td {
            padding: 1rem;
            color: var(--txt-medio);
            font-size: 0.9rem;
            vertical-align: middle;
        }

        /* Botón Volver */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.8rem 2rem;
            background: #ef4444;
            color: white;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: #dc2626;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.3);
        }

        .loading-text {
            color: var(--accent);
            font-weight: 600;
            padding: 2rem !important;
        }
    </style>
    <link rel="stylesheet" href="css/base.css">

<body class="app-bg">

<div class="container">
    <div class="panel-busqueda animate__animated animate__fadeInUp">
        
        <div class="panel-header">
            <h2><i class="bi bi-person-search text-primary"></i> Buscador de Empleados</h2>
            <p class="text-muted small">Filtre la información de forma instantánea</p>
        </div>

        <!-- BUSCADOR -->
        <div class="search-box animate__animated animate__fadeIn">
            <i class="bi bi-search"></i>
            <input type="text" id="buscar" class="form-control" 
                   placeholder="Escriba nombre, CI, cargo o intereses...">
        </div>

        <!-- TABLA -->
        <div class="table-responsive shadow-sm">
            <table class="table text-center align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cargo</th>
                        <th>CI</th>
                        <th>Nombre Completo</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Fecha Nac.</th>
                        <th>Género</th>
                        <th>Intereses</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="tabla">
                    <tr>
                        <td colspan="10" class="text-muted py-5">
                            <i class="bi bi-keyboard fs-2 d-block mb-2"></i>
                            Comience a escribir para visualizar resultados...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- BOTÓN VOLVER -->
        <div class="text-center mt-5">
            <a href="../controller/empleadoListaCo.php" class="btn-back">
                <i class="bi bi-arrow-left-circle"></i> Volver a la Lista
            </a>
        </div>

    </div>
</div>

<script>
    document.getElementById("buscar").addEventListener("keyup", function() {
        let valor = this.value;
        let tabla = document.getElementById("tabla");

        if(valor.trim() === "") {
            tabla.innerHTML = '<tr><td colspan="10" class="text-muted py-5"><i class="bi bi-keyboard fs-2 d-block mb-2"></i>Comience a escribir para visualizar resultados...</td></tr>';
            return;
        }

        // Indicador de carga
        tabla.innerHTML = "<tr><td colspan='10' class='loading-text'><div class='spinner-border spinner-border-sm me-2' role='status'></div>Buscando coincidencias...</td></tr>";

        fetch("../controller/empleadoBusqueda.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "buscar=" + encodeURIComponent(valor)
        })
        .then(res => res.text())
        .then(html => {
            tabla.innerHTML = html;
            // Aplicar una pequeña animación a las nuevas filas
            tabla.classList.remove("animate__animated", "animate__fadeIn");
            void tabla.offsetWidth; // Trigger reflow
            tabla.classList.add("animate__animated", "animate__fadeIn");
        })
        .catch(error => {
            tabla.innerHTML = "<tr><td colspan='10' class='text-danger'>Error al conectar con el servidor</td></tr>";
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>