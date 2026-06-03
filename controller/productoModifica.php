<?php
include(__DIR__ . "/../model/productoClase.php");
include(__DIR__ . "/../model/proveedorClase.php");

$id = isset($_POST['cod']) ? intval($_POST['cod']) : (isset($_GET['cod']) ? intval($_GET['cod']) : 0);
$prod = new Producto($id, 0, "", "", "Activo", 0, 0, "", "");
$proveedor = new Proveedor("", "", "", "", "", "", "");
$proveedores = $proveedor->listarProveedor();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificarProducto'])) {
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

    $idProveedor = intval($_POST['id_proveedor'] ?? 0);
    $nombreproducto = $_POST['nombreproducto'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $estado = $_POST['estado'] ?? 'Activo';
    $precio = floatval($_POST['precio'] ?? 0);
    $stock = intval($_POST['stock'] ?? 0);
    $tipo = $_POST['tipo'] ?? '';

    $r = $prod->editarProducto($idProveedor, $nombreproducto, $descripcion, $estado, $precio, $stock, $tipo, $imagen);

    if ($r) {
        echo "<script>
                alert('Producto modificado correctamente');
                window.location='../controller/productoLista.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Error al modificar producto');</script>";
    }
}

$res = $prod->listarProductoId();
include("../view/productoModifica.php");
