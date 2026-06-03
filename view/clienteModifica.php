<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/empleado-style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/base.css">


<body class="bg-info-subtle app-bg">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 animate__animated animate__fadeIn">

                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h3 class="fw-bold mb-0">
                        <i class="fa-solid fa-pen-to-square me-2"></i> Editar Cliente
                    </h3>
                    <small class="text-light">Actualiza la información del registro</small>
                </div>

                <div class="card-body bg-white p-4">

                    <?php
                    // $res viene de Cliente::listarClienteId()
                    if (isset($res) && count($res) > 0) {
                        $reg = $res[0]; // solo un registro
                    ?>

                        <form method="post" action="../controller/clienteModifica.php">

                            <input type="hidden" name="cod" value="<?php echo $reg['id_cliente']; ?>">

                            <div class="form-floating mb-3">
                                <input type="text" name="razon" id="razon"
                                    value="<?php echo htmlspecialchars($reg['razonsocial'], ENT_QUOTES); ?>"
                                    class="form-control rounded-3 border-primary"
                                    placeholder="Razón Social" required>
                                <label for="razon"><i class="fa-solid fa-building me-1 text-primary"></i> Razón Social</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="text" name="nit" id="nit"
                                    value="<?php echo htmlspecialchars($reg['nit_ci'], ENT_QUOTES); ?>"
                                    class="form-control rounded-3 border-primary"
                                    placeholder="NIT / CI" required>
                                <label for="nit"><i class="fa-solid fa-id-card me-1 text-primary"></i> NIT / CI</label>
                            </div>

                            <div class="d-grid gap-3">
                                <button type="submit" name="modificar" class="btn btn-primary btn-lg rounded-pill animate__animated animate__pulse animate__infinite">
                                    <i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios
                                </button>

                                <a href="../controller/clienteLista.php" class="btn btn-outline-primary rounded-pill">
                                    <i class="fa-solid fa-arrow-left me-2"></i> Volver
                                </a>
                            </div>

                        </form>

                    <?php } else { ?>
                        <p class="text-center text-muted">No se encontró el cliente.</p>
                    <?php } ?>

                </div>

                <div class="card-footer bg-light text-center small text-muted">
                    Brandon Alavi Salazar © 2026
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>