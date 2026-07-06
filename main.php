<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: main.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes · Panel</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            /* Variables para el tema Azul Claro */
            --bg-fondo: #f0f9ff;
            --bg-panel: #ffffff;
            --bg-borde: #e0f2fe;
            --txt-oscuro: #0c4a6e;
            --txt-medio: #334155;
            --txt-claro: #64748b;
            --btn-nuevo: #0ea5e9;
            
            /* Colores de acento por entidad */
            --color-clientes: #0ea5e9;
            --color-cargos: #10b981;
            --color-empleados: #f59e0b;
            --color-proveedores: #8b5cf6; /* Nuevo color para proveedores */
            --color-productos: #8b5cf6; /* Nuevo color para productos */
            --color-salir: #ef4444; /* Color para el botón salir */
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
            
            /* Fondo con imagen y degradado azul claro */
            background-color: var(--bg-fondo);
            background-image: 
                linear-gradient(rgba(240, 249, 255, 0.8), rgba(186, 230, 253, 0.6)), 
                url('https://images.unsplash.com/photo-1550684376-efcbd6e3f031?q=80&w=2500&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            
            min-height: 100vh;
            color: var(--txt-medio);
            font-family: 'Inter', sans-serif;
        }

        /* Panel Principal (Efecto cristal claro) */
        .panel {
            width: 100%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(12, 74, 110, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(12px);
            padding: 2.5rem;
        }

        .panel-header {
            text-align: center;
            margin-bottom: 3rem;
            border-bottom: 2px solid var(--bg-borde);
            padding-bottom: 2rem;
        }

        .panel-header h1 {
            color: var(--txt-oscuro);
            font-weight: 900;
            letter-spacing: -1px;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .panel-header p {
            color: var(--txt-claro);
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 0.5rem;
        }

        .entidades-grid {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .entidad-card {
            background: #ffffff;
            border: 1px solid var(--bg-borde);
            border-radius: 20px;
            padding: 1.8rem;
            display: flex;
            flex-direction: row;
            align-items: center;
            transition: all .3s ease;
            position: relative;
        }

        .entidad-card:hover {
            transform: scale(1.01) translateY(-2px);
            box-shadow: 0 10px 25px rgba(12, 74, 110, 0.08);
        }

        /* Indicador lateral de color */
        .card-clientes { border-left: 6px solid var(--color-clientes); }
        .card-cargos { border-left: 6px solid var(--color-cargos); }
        .card-empleados { border-left: 6px solid var(--color-empleados); }
        .card-proveedores { border-left: 6px solid var(--color-proveedores); }
        .card-productos { border-left: 6px solid var(--color-productos); }
        .entidad-header {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.8rem;
            flex: 0 0 240px;        
            border-right: 2px dashed var(--bg-borde);
            padding-right: 2rem;
            margin-right: 2rem;
        }

        .entidad-icono {
            width: 3.8rem;
            height: 3.8rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .entidad-icono--clientes { background: linear-gradient(135deg, var(--color-clientes), #0284c7); }
        .entidad-icono--cargos   { background: linear-gradient(135deg, var(--color-cargos), #059669); }
        .entidad-icono--empleados { background: linear-gradient(135deg, var(--color-empleados), #d97706); }
        .entidad-icono--proveedores { background: linear-gradient(135deg, var(--color-proveedores), #6d28d9); }
        .entidad-icono--productos { background: linear-gradient(135deg, var(--color-productos), #8b5cf6); }
        .entidad-titulo {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--txt-oscuro);
        }

        .entidad-links {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            width: 100%;
        }

        .entidad-link {
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: 0.85rem 1.2rem;
            background: var(--bg-fondo);
            border: 1px solid var(--bg-borde);
            border-radius: 10px;
            text-decoration: none;
            color: var(--txt-medio);
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .entidad-link:hover {
            background: #ffffff;
            border-color: var(--btn-nuevo);
            color: var(--btn-nuevo);
            transform: translateX(4px);
        }

        .entidad-link i {
            font-size: 1.1rem;
            color: var(--txt-claro);
        }

        .entidad-link:hover i {
            color: var(--btn-nuevo);
        }

        .link-flecha {
            margin-left: auto;
            font-size: 0.8rem;
            opacity: 0.4;
        }

        /* Estilo especial para el botón salir */
        .btn-salir-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
        }

        .btn-salir {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.85rem 2rem;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(255, 75, 43, 0.3);
        }

        .btn-salir:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 75, 43, 0.5);
            color: white;
        }

        @media (max-width: 768px) {
            .entidad-card { flex-direction: column; text-align: center; }
            .entidad-header { 
                flex: none; border-right: none; border-bottom: 2px dashed var(--bg-borde);
                padding-right: 0; margin-right: 0; padding-bottom: 1.5rem; margin-bottom: 1.5rem;
                align-items: center; width: 100%;
            }
            .entidad-links { grid-template-columns: 1fr; }
            .btn-salir-container { justify-content: center; }
        }
    </style>
</head>
<body>

<div class="panel">

    <div class="panel-header">
        <h1><i class="bi bi-people-fill text-primary"></i> GESTIÓN DE ENTIDADES</h1>
        <p>Menú Principal de Administración</p>
    </div>

    <div class="entidades-grid">

        <!-- Sección Clientes -->
        <div class="entidad-card card-clientes">
            <div class="entidad-header">
                <div class="entidad-icono entidad-icono--clientes"><i class="bi bi-person-lines-fill"></i></div>
                <div class="entidad-titulo">CLIENTES</div>
            </div>
            <div class="entidad-links">
                <a href="controller/clienteLista.php" class="entidad-link">
                    <i class="bi bi-person-check-fill"></i> Clientes Activos
                    <i class="bi bi-chevron-right link-flecha"></i>
                </a>
                <a href="controller/clienteListaInactivos.php" class="entidad-link">
                    <i class="bi bi-person-x-fill"></i> Clientes Inactivos
                    <i class="bi bi-chevron-right link-flecha"></i>
                </a>
            </div>
        </div>

        <!-- Sección Cargos -->
        <div class="entidad-card card-cargos">
            <div class="entidad-header">
                <div class="entidad-icono entidad-icono--cargos"><i class="bi bi-briefcase-fill"></i></div>
                <div class="entidad-titulo">CARGOS</div>
            </div>
            <div class="entidad-links">
                <a href="controller/cargoLista.php" class="entidad-link">
                    <i class="bi bi-list-task"></i> Lista de Cargos
                    <i class="bi bi-chevron-right link-flecha"></i>
                </a>
            </div>
        </div>

        <!-- Sección Empleados -->
        <div class="entidad-card card-empleados">
            <div class="entidad-header">
                <div class="entidad-icono entidad-icono--empleados"><i class="bi bi-person-badge-fill"></i></div>
                <div class="entidad-titulo">EMPLEADOS</div>
            </div>
            <div class="entidad-links">
                <a href="controller/empleadoLista.php" class="entidad-link">
                    <i class="bi bi-person-vcard"></i> Lista Empleados
                    <i class="bi bi-chevron-right link-flecha"></i>
                </a>
            </div>
        </div>

        <!-- Sección Proveedores -->
        <div class="entidad-card card-proveedores">
            <div class="entidad-header">
                <div class="entidad-icono entidad-icono--proveedores"><i class="bi bi-truck"></i></div>
                <div class="entidad-titulo">PROVEEDOR</div>
            </div>
            <div class="entidad-links">
                <a href="controller/proveedorLista.php" class="entidad-link">
                    <i class="bi bi-boxes"></i> Lista Proveedores
                    <i class="bi bi-chevron-right link-flecha"></i>
                </a>
            </div>
        </div>
        <!-- Seccion Productos -->
        <div class="entidad-card card-productos">
            <div class="entidad-header">
                <div class="entidad-icono entidad-icono--productos"><i class="bi bi-cart"></i></div>
                <div class="entidad-titulo">PRODUCTOS</div>
            </div>
            <div class="entidad-links">
                <a href="controller/productoLista.php" class="entidad-link">
                    <i class="bi bi-cart-check"></i> Productos Activos
                    <i class="bi bi-chevron-right link-flecha"></i>
                </a>
                <a href="controller/productoCatalogo.php" class="entidad-link">
                    <i class="bi bi-window-sidebar"></i> Catálogo de Productos
                    <i class="bi bi-chevron-right link-flecha"></i>
                </a>
                <a href="controller/productoListaInactivos.php" class="entidad-link">
                    <i class="bi bi-cart-x"></i> Productos Inactivos
                    <i class="bi bi-chevron-right link-flecha"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Botón Salir -->
    <div class="btn-salir-container">
        <a href="logout.php" class="btn-salir">
            <i class="bi bi-box-arrow-right"></i> Salir del Sistema
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>