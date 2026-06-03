<?php
include("../model/empleadoClase.php");

// RECIBE ID (permitir venir por GET o POST - formulario ahora incluye campo oculto `cod`)
$id = null;
if (isset($_REQUEST['cod']) && $_REQUEST['cod'] !== '') {
    $id = intval($_REQUEST['cod']);
} elseif (isset($_GET['cod']) && $_GET['cod'] !== '') {
    $id = intval($_GET['cod']);
}

if ($id === null) {
    echo "<script>alert('ID de empleado no proporcionado.'); window.location='../controller/empleadoLista.php';</script>";
    exit;
}

$emp = new Empleado($id, "", "", "", "", "", "", "", "", "", "");
$resultado = $emp->listarEmpleadoId();

// SI ENVÍA FORM
if (isset($_POST['modificarEmpleado'])) {

    $r = $emp->editarEmpleado(
        $_POST['idcargo'],
        $_POST['ci'],
        $_POST['nombre'],
        $_POST['paterno'],
        $_POST['materno'],
        $_POST['direccion'],
        $_POST['telefono'],
        $_POST['fecha_nacimiento'],
        $_POST['genero'],
        $_POST['intereses']
    );

    if ($r) {
        echo "<script>
                alert('Empleado modificado correctamente');
                window.location='../controller/empleadoLista.php';
              </script>";
    } else {
        echo "<script>alert('Error al modificar');</script>";
    }
}

// LLAMA AL VIEW
include("../view/empleadoModifica.php");
