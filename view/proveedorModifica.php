<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar Proveedor</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/base.css">


<body class="bg-info-subtle app-bg">

    <div class="container py-5">

        <div class="card border-0 shadow-lg rounded-4 animate__animated animate__fadeIn">

            <!-- HEADER -->
            <div class="card-header bg-primary bg-gradient text-white text-center py-4 rounded-top-4">
                <h2 class="fw-bold animate__animated animate__fadeInDown">
                    <i class="fa-solid fa-pen me-2"></i>
                    Modificar Proveedor
                </h2>
            </div>

            <!-- BODY -->
            <div class="card-body p-4">

                <form method="post" enctype="multipart/form-data">

                    <?php foreach ($resultado as $reg) { ?>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Empresa</label>
                            <input type="text" name="empresa" class="form-control rounded-3"
                                value="<?php echo $reg['empresa']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Contacto</label>
                            <input type="text" name="contacto" class="form-control rounded-3"
                                value="<?php echo $reg['contacto']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Correo</label>
                            <input type="email" name="mail" class="form-control rounded-3"
                                value="<?php echo $reg['mail']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Teléfono</label>
                            <input type="number" name="telefono" class="form-control rounded-3"
                                value="<?php echo $reg['telefono']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Dirección</label>
                            <input type="text" name="direccion" class="form-control rounded-3"
                                value="<?php echo $reg['direccion']; ?>">
                        </div>

                        <!-- LOGO ACTUAL -->
                        <div class="mb-3 text-center">
                            <label class="form-label fw-semibold">Logo actual</label><br>

                            <?php
                            if (!empty($reg['logo']) && file_exists("../img/" . $reg['logo'])) {
                                echo "<img src='../img/" . $reg['logo'] . "' style='width:80px;height:80px;object-fit:cover;border-radius:10px;'>";
                            } else {
                                echo "<span class='text-muted'>Sin logo</span>";
                            }
                            ?>
                        </div>

                        <!-- CAMBIAR LOGO -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Cambiar logo</label>
                            <input type="file" name="logo" class="form-control rounded-3">
                        </div>

                    <?php } ?>

                    <!-- BOTONES -->
                    <div class="text-center mt-4">

                        <button type="submit"
                            name="modificarProveedor"
                            class="btn btn-primary btn-lg rounded-pill me-3 shadow animate__animated animate__pulse animate__infinite">

                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Guardar Cambios

                        </button>

                        <a href="../controller/proveedorLista.php"
                            class="btn btn-outline-primary btn-lg rounded-pill">

                            <i class="fa-solid fa-arrow-left me-2"></i>
                            Volver

                        </a>

                    </div>

                </form>

            </div>

            <!-- FOOTER -->
            <div class="card-footer text-center small text-muted bg-light">
                <i class="fa-solid fa-code me-1"></i>
                Sistema Proveedores © 2026
            </div>

        </div>

    </div>

</body>

</html>