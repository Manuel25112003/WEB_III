<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Proveedor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/base.css">


<body class="bg-info-subtle app-bg">

    <div class="container py-5">

        <div class="card shadow-lg rounded-4">

            <!-- HEADER -->
            <div class="card-header bg-primary text-white text-center py-4">
                <h2><i class="fa-solid fa-magnifying-glass"></i> Buscar Proveedor</h2>
            </div>

            <!-- BODY -->
            <div class="card-body">

                <form method="post" class="mb-4">

                    <div class="input-group">
                        <input type="text" name="buscar" class="form-control" placeholder="Empresa, contacto o correo">
                        <button type="submit" name="buscarProveedor" class="btn btn-primary">
                            Buscar
                        </button>
                    </div>

                </form>

                <div class="table-responsive">

                    <table class="table table-hover text-center">

                        <thead class="table-info">
                            <tr>
                                <th>ID</th>
                                <th>Empresa</th>
                                <th>Contacto</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Logo</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            if ($resultado && count($resultado) > 0) {
                                foreach ($resultado as $reg) {

                                    echo "<tr>";
                                    echo "<td>" . $reg['id_proveedor'] . "</td>";
                                    echo "<td>" . $reg['empresa'] . "</td>";
                                    echo "<td>" . $reg['contacto'] . "</td>";
                                    echo "<td>" . $reg['mail'] . "</td>";
                                    echo "<td>" . $reg['telefono'] . "</td>";
                                    echo "<td>" . $reg['direccion'] . "</td>";

                                    echo "<td>";
                                    if ($reg['logo']) {
                                        echo "<img src='../img/" . $reg['logo'] . "' width='50'>";
                                    } else {
                                        echo "Sin logo";
                                    }
                                    echo "</td>";

                                    echo "<td>
                <a href='../controller/proveedorModifica.php?cod=" . $reg['id_proveedor'] . "' class='btn btn-outline-primary btn-sm'>Modificar</a>
                <a href='../controller/proveedorEliminar.php?cod=" . $reg['id_proveedor'] . "' class='btn btn-outline-danger btn-sm'>Eliminar</a>
              </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No se encontraron resultados</td></tr>";
                            }
                            ?>

                        </tbody>

                    </table>

                </div>

                <!-- BOTONES -->
                <div class="text-center mt-4">
                    <a href="../controller/proveedorLista.php" class="btn btn-danger btn-lg rounded-pill">
                        Volver
                    </a>
                </div>

            </div>

        </div>

    </div>

</body>

</html>