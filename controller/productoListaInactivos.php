<?php
include(__DIR__ . "/../model/productoClase.php");

$prod = new Producto("", 0, "", "", "Activo", 0, 0, "", "");
$resultado = $prod->listarProductoInactivo();

include(__DIR__ . "/../view/productoListaI.php");
