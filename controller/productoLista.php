<?php
include("../model/productoClase.php");

$prod = new Producto("", 0, "", "", "Activo", 0, 0, "", "");
$resultado = $prod->listarProducto();

include("../view/productoLista.php");
