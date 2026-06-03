<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../model/proveedorClase.php");

if (isset($_POST['registrarProveedor'])) {

    $logo = "";

    if (isset($_FILES['logo']) && $_FILES['logo']['name'] != "") {

        $nombreArchivo = $_FILES['logo']['name'];
        $tmp = $_FILES['logo']['tmp_name'];

        $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "avif" || $ext == "webp") {

            // nombre único
            $nombreArchivo = time() . "_" . $nombreArchivo;

            // ruta REAL del servidor (IMPORTANTE)
            $rutaDestino = __DIR__ . "/../img/" . $nombreArchivo;

            if (move_uploaded_file($tmp, $rutaDestino)) {
                // SOLO guardamos el nombre
                $logo = $nombreArchivo;
            } else {
                echo "<script>alert('Error al subir la imagen');</script>";
            }
        } else {
            echo "<script>alert('Solo se permite JPG, JPEG, PNG, AVIF o WEBP');</script>";
        }
    }

    $prov = new Proveedor(
        "",
        $_POST['empresa'],
        $_POST['contacto'],
        $_POST['mail'],
        $_POST['telefono'],
        $_POST['direccion'],
        $logo
    );

    $r = $prov->grabarProveedor();

    if ($r) {
        echo "<script>
                alert('Proveedor registrado correctamente');
                window.location='../controller/proveedorLista.php';
              </script>";
    } else {
        echo "<script>alert('Error al registrar proveedor');</script>";
    }
}

include("../view/proveedorRegistro.php");
