<?php
include("../model/cargoClase.php");

// Inicializamos $res vacío
$res = [];

// Si se hizo búsqueda
if (isset($_GET['Buscar'])) {
    $ca = trim($_GET['cargo']);
    $car = new Cargo("", "");
    $res = $car->buscarCargo($ca); // devuelve array de resultados
}
// Si no se hizo búsqueda, listamos todos los cargos
else {
    $car = new Cargo("", "");
    $res = $car->listarCargo(); // todos los cargos
}

// Cargar la vista
include("../view/cargoBusqueda.php");
