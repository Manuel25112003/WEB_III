<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include(__DIR__ . "/../model/empleadoClase.php");
include(__DIR__ . "/../model/cargoClase.php");

$cargo = new Cargo("", "");
$cargos = $cargo->listarCargo();

if (isset($_POST['registrarEmpleado'])) {

    $emp = new Empleado(
        "",
        $_POST['idcargo'] ?? 0,
        $_POST['ci'] ?? '',
        $_POST['nombre'] ?? '',
        $_POST['paterno'] ?? '',
        $_POST['materno'] ?? '',
        $_POST['direccion'] ?? '',
        $_POST['telefono'] ?? '',
        $_POST['fecha_nacimiento'] ?? null,
        $_POST['genero'] ?? '',
        $_POST['intereses'] ?? []
    );

    $r = $emp->grabarEmpleado();

    if ($r) {
        echo "<script>alert('Empleado registrado correctamente'); location.href='empleadoLista.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error al registrar');</script>";
    }
}

include(__DIR__ . "/../view/empleadoRegistro.php");
