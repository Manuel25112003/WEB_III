<?php
include("../model/empleadoClase.php");

$emp = new Empleado("", "", "", "", "", "", "", "", "", "", "");
$resultado = $emp->listarEmpleado();

include("../view/empleadoLista.php");
