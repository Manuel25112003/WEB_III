<?php
include("../model/clienteClase.php");

// Inicializamos $res vacío
$res = [];

// Si se hizo búsqueda
if (isset($_GET['Buscar'])) {
    $rs = trim($_GET['razon']);
    $cli = new Cliente("", "", "", "");
    $res = $cli->buscarClienteInac($rs); // devuelve array de resultados
}

// Si no se hizo búsqueda, listamos todos los clientes activos
else {
    $cli = new Cliente("", "", "", "");
    $res = $cli->listarClienteInactivo(); // todos los clientes activos
}

// Cargar la vista
include("../view/clienteBusquedaInac.php");
