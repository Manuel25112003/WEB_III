<?php
include(__DIR__ . "/../model/productoClase.php");

$id = isset($_GET['cod']) ? intval($_GET['cod']) : 0;
$prod = new Producto($id, 0, "", "", "", 0, 0, "", "");
$prod->eliminarProducto();

header('Location: productoListaInactivos.php');
exit();
