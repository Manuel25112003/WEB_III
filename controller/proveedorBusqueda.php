<?php
include("../model/proveedorClase.php");

$resultado = [];

if (isset($_POST['buscarProveedor'])) {

    $busqueda = $_POST['buscar'];

    $prov = new Proveedor("", "", "", "", "", "", "");
    $resultado = $prov->buscarProveedor($busqueda);
}

include("../view/proveedorBusqueda.php");
