<?php
include("../model/productoClase.php");
include("../model/proveedorClase.php");

$proveedor = new Proveedor("", "", "", "", "", "", "");
$proveedores = $proveedor->listarProveedor();

if (isset($_POST['registrarProducto'])) {
    $imagen = "";

    if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != "") {
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $tmp = $_FILES['imagen']['tmp_name'];
        $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $nombreArchivo = time() . "_" . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $nombreArchivo);
            $rutaDestino = __DIR__ . "/../img/" . $nombreArchivo;

            if (move_uploaded_file($tmp, $rutaDestino)) {
                $imagen = $nombreArchivo;
            } else {
                echo "<script>alert('Error al subir la imagen');</script>";
            }
        } else {
            echo "<script>alert('Solo se permiten archivos JPG, JPEG, PNG o WEBP');</script>";
        }
    }

    $prod = new Producto(
        "",
        intval($_POST['id_proveedor'] ?? 0),
        $_POST['nombreproducto'] ?? '',
        $_POST['descripcion'] ?? '',
        'Activo',
        floatval($_POST['precio'] ?? 0),
        intval($_POST['stock'] ?? 0),
        $_POST['tipo'] ?? '',
        $imagen
    );

    $r = $prod->grabarProducto();

    if ($r) {
        echo "<script>
                alert('Producto registrado correctamente');
                window.location='../controller/productoLista.php';
            </script>";
        exit();
    } else {
        echo "<script>alert('Error al registrar producto');</script>";
    }
}

include("../view/productoRegistro.php");
