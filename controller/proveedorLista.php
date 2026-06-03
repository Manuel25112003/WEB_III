<?php
include("../model/proveedorClase.php");

$prov = new Proveedor("", "", "", "", "", "", "");
$resultado = $prov->listarProveedor();

include("../view/proveedorLista.php");
