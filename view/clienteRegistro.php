<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Cliente</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

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
            align-items: center; 
            justify-content: center;
            padding: 3rem 1rem;
            margin: 0;
        }

        /* Panel Principal (Efecto cristal) */
        .pagina { 
            max-width: 550px; /* Diseño vertical y compacto */
            width: 100%;
            background: rgba(255, 255, 255, 0.90);
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
            text-align: center;
        }
        .encabezado-titulo { font-size: 1.8rem; font-weight: 800; color: var(--txt-oscuro, #0c4a6e); }
        .encabezado-sub { font-size: 0.9rem; color: var(--txt-claro, #64748b); text-transform: uppercase; letter-spacing: 1px; }

        /* Estilos de Formulario */
        .form-group { margin-bottom: 1.5rem; }
        .form-label { 
            font-weight: 600; 
            color: #334155; 
            font-size: 0.9rem; 
            margin-bottom: 0.5rem; 
            display: block; 
        }
        .form-control {
            width: 100%; 
            padding: 0.75rem 1rem; 
            font-size: 0.95rem;
            border: 1px solid #cbd5e1; 
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.6); 
            transition: all 0.2s ease-in-out;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
        }
        .form-control:focus {
            outline: none; 
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
            background: #fff;
        }
        
        /* Botones unificados - Totalmente verticales */
        .acciones { 
            display: flex; 
            flex-direction: column; 
            gap: 1rem; 
            margin-top: 2.5rem; 
        }
        .btn-guardar, .btn-volver {
            display: flex; 
            align-items: center; 
            justify-content: center;
            width: 100%;
            padding: 0.85rem 1.5rem; 
            border-radius: 10px; 
            text-decoration: none; 
            font-size: 0.95rem; 
            font-weight: 600; 
            transition: all 0.2s; 
            border: none; 
            cursor: pointer;
        }
        
        .btn-guardar { background: #0ea5e9; color: white; box-shadow: 0 4px 6px rgba(14, 165, 233, 0.2); }
        .btn-guardar:hover { background: #0284c7; color: white; transform: translateY(-2px); box-shadow: 0 6px 12px rgba(14, 165, 233, 0.3); }
        
        .btn-volver { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .btn-volver:hover { background: #e2e8f0; color: #334155; transform: translateY(-2px); }

        .footer-creditos { text-align: center; margin-top: 2rem; font-size: 0.85rem; color: var(--txt-claro, #94a3b8); font-weight: 500; }

        @media (max-width: 768px) {
            .pagina { padding: 2rem 1.5rem; border-radius: 16px; }
        }
    </style>
    <link rel="stylesheet" href="css/base.css">
</head>

<body class="app-bg">
<div class="pagina">

    <div class="encabezado">
        <div class="encabezado-titulo"><i class="bi bi-person-plus me-2"></i>Nuevo Cliente</div>
        <div class="encabezado-sub">Complete la información para registrar</div>
    </div>

    <form method="post">

        <div class="form-group">
            <label class="form-label" for="razon"><i class="bi bi-building me-1 text-secondary"></i> Razón Social</label>
            <input type="text" name="razon" id="razon" class="form-control" placeholder="Razón Social" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="nit"><i class="bi bi-person-vcard me-1 text-secondary"></i> NIT o CI</label>
            <input type="text" name="nit" id="nit" class="form-control" placeholder="NIT o CI" required>
        </div>

        <div class="acciones">
            <button type="submit" name="registrarCliente" class="btn-guardar">
                <i class="bi bi-floppy-fill me-2"></i>Registrar Cliente
            </button>
            <a href="../controller/clienteLista.php" class="btn-volver">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

    </form>

    <div class="footer-creditos">
        <i class="bi bi-code-slash me-1"></i> Brandon Alavi Salazar &copy; 2026
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>