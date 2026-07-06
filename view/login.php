<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso · Sistema</title>

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
            background-color: #f0f9ff;
            background-image: linear-gradient(rgba(240, 249, 255, 0.9), rgba(186, 230, 253, 0.9)),
                url('https://images.unsplash.com/photo-1550684376-efcbd6e3f031?q=80&w=2500&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(14, 165, 233, 0.16);
            border-radius: 24px;
            box-shadow: 0 22px 60px rgba(12, 74, 110, 0.12);
            padding: 2.5rem;
            backdrop-filter: blur(12px);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 800;
            color: #0c4a6e;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            border-radius: 14px;
            border: 1px solid #cbd5e1;
            padding: 0.95rem 1rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 0.2rem rgba(14, 165, 233, 0.18);
        }

        .btn-login {
            width: 100%;
            padding: 0.95rem 1rem;
            border-radius: 14px;
            border: none;
            font-weight: 700;
            font-size: 1rem;
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: white;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(14, 165, 233, 0.2);
        }

        .login-footer {
            margin-top: 1.5rem;
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
        }

        .alert-login {
            margin-bottom: 1.5rem;
            border-radius: 14px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="login-title"><i class="bi bi-lock-fill me-2"></i>Acceso</div>
            <div class="login-subtitle">Ingresa con tu usuario y contraseña</div>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-login" role="alert">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') ?>" autocomplete="off">
            <div class="mb-4">
                <label class="form-label" for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?= isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label" for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" name="login" class="btn btn-login"><i class="bi bi-box-arrow-in-right me-2"></i>Ingresar</button>
        </form>

        <div class="login-footer">
            <a href="../index.php" class="text-decoration-none">Volver al inicio</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
