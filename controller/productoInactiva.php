<?php
$cod = isset($_GET['cod']) ? intval($_GET['cod']) : 0;
include(__DIR__ . "/../model/productoClase.php");

$prod = new Producto($cod, 0, "", "", "Activo", 0, 0, "", "");
$res = $prod->inactivarProducto();

if ($res) {
    echo "<script>alert('Producto inactivado correctamente'); location.href='../controller/productoListaInactivos.php';</script>";
} else {
    echo "<script>alert('Error al inactivar producto'); location.href='../controller/productoLista.php';</script>";
}
