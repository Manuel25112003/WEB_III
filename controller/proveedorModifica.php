<?php
include("../model/proveedorClase.php");

// ID
$id = $_GET['cod'];

$prov = new Proveedor($id, "", "", "", "", "", "");
$resultado = $prov->listarProveedorId();

// SI ENVÍA
if (isset($_POST['modificarProveedor'])) {

    $logo = "";

    if (isset($_FILES['logo']) && $_FILES['logo']['name'] != "") {
        $logo = $_FILES['logo']['name'];
    }

    $r = $prov->editarProveedor(
        $_POST['empresa'],
        $_POST['contacto'],
        $_POST['mail'],
        $_POST['telefono'],
        $_POST['direccion'],
        $logo
    );

    if ($r) {
        echo "<script>
                alert('Proveedor modificado correctamente');
                window.location='../controller/proveedorLista.php';
              </script>";
    } else {
        echo "<script>alert('Error al modificar');</script>";
    }
}

include("../view/proveedorModifica.php");
