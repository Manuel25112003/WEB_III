<?php
$cod = isset($_GET['cod']) ? intval($_GET['cod']) : 0;
include(__DIR__ . "/../model/productoClase.php");

$prod = new Producto($cod, 0, "", "", "Activo", 0, 0, "", "");
$res = $prod->activarProducto();

if ($res) {
    echo "<script>alert('Producto activado correctamente'); location.href='productoLista.php';</script>";
} else {
    echo "<script>alert('Error al activar producto'); location.href='productoListaInactivos.php';</script>";
}
