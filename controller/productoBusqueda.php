<?php
include("../model/productoClase.php");

$termino = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';
$prod = new Producto("", 0, "", "", "Activo", 0, 0, "", "");
$res = [];

if ($termino !== '') {
    $res = $prod->buscarProducto($termino);
}

include("../view/productoBusqueda.php");
