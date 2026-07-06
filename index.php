
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Virtual | Gestión Empresarial</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-fondo: #f0f9ff;
            --txt-oscuro: #0c4a6e;
            --txt-medio: #334155;
            --btn-nuevo: #0ea5e9;
        }

        body {
            background-color: var(--bg-fondo);
            font-family: 'Inter', sans-serif;
            color: var(--txt-medio);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1rem 0;
        }

        /* Banner */
        .banner {
            background: linear-gradient(135deg, var(--txt-oscuro), var(--btn-nuevo));
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        /* Footer */
        footer {
            background: var(--txt-oscuro);
            color: white;
            padding: 2rem;
            margin-top: auto;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <nav class="container navbar navbar-expand-lg">
        <a class="navbar-brand fw-bold" href="#" style="color: var(--txt-oscuro);">EMPRESA WEB</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="#">Inicio</a>
            <a class="nav-link" href="view/productoCatalogo.php">Catálogo</a>
            <a class="nav-link" href="view/login.php" class="btn btn-primary">Acceder</a>
        </div>
    </nav>
</header>

<div class="banner">
    <h1>Bienvenido a nuestra Tienda Virtual</h1>
    <p>Calidad y confianza en cada uno de nuestros productos.</p>
</div>

<main class="container py-5 text-center">
    <h2>Nuestra Misión</h2>
    <p>Proporcionar las mejores soluciones digitales para tu gestión diaria.</p>
</main>

<footer>
    <div class="container">
        <h5>Tienda Virtual - Sistema WEBIII</h5>
        <p>Contacto: info@empresa.com | Tel: +591 2 123456</p>
        <small>©️ 2026 Todos los derechos reservados.</small>
    </div>
</footer>

</body>
</html>