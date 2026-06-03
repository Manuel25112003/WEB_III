<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Cargo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/empleado-style.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/base.css">


<body class="bg-info-subtle app-bg">

    <div class="container py-5">

        <div class="col-md-6 mx-auto">

            <div class="card border-0 shadow-lg rounded-4 animate__animated animate__fadeIn">

                <!-- HEADER -->
                <div class="card-header bg-primary bg-gradient text-white text-center py-4 rounded-top-4">
                    <h2 class="fw-bold animate__animated animate__fadeInDown">
                        <i class="fa-solid fa-pen-to-square me-2"></i>
                        Editar Cargo
                    </h2>
                </div>

                <!-- BODY -->
                <div class="card-body p-4">

                    <?php
                    if (isset($res) && count($res) > 0) {
                        $reg = $res[0];
                    ?>

                        <form method="post" action="../controller/cargoModifica.php">

                            <input type="hidden" name="cod" value="<?php echo $reg['id_cargo']; ?>">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Cargo</label>
                                <input type="text"
                                    name="cargo"
                                    value="<?php echo htmlspecialchars($reg['cargo'], ENT_QUOTES); ?>"
                                    class="form-control rounded-3"
                                    required>
                            </div>

                            <!-- BOTONES -->
                            <div class="text-center mt-4">

                                <button type="submit"
                                    name="modificar"
                                    class="btn btn-primary btn-lg rounded-pill me-3 shadow animate__animated animate__pulse animate__infinite">

                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                    Guardar Cambios

                                </button>

                                <a href="../controller/cargoLista.php"
                                    class="btn btn-outline-primary btn-lg rounded-pill">

                                    <i class="fa-solid fa-arrow-left me-2"></i>
                                    Volver

                                </a>

                            </div>

                        </form>

                    <?php } else { ?>

                        <div class="text-center text-muted py-4">
                            <i class="fa-solid fa-circle-info fa-lg me-2"></i>
                            No se encontró el cargo.
                        </div>

                    <?php } ?>

                </div>

                <!-- FOOTER -->
                <div class="card-footer text-center small text-muted bg-light">
                    <i class="fa-solid fa-code me-1"></i>
                    Sistema © 2026
                </div>

            </div>

        </div>

    </div>

</body>

</html>