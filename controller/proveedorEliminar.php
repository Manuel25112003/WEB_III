<?php
include("../model/proveedorClase.php");

// RECIBE EL ID
$id = $_GET['cod'];

// CREA OBJETO
$prov = new Proveedor($id, "", "", "", "", "", "");

// EJECUTA ELIMINAR
$r = $prov->eliminarProveedor();

if ($r) {
?>
    <script>
        alert('Proveedor eliminado correctamente');
        window.location = "../controller/proveedorLista.php";
    </script>
<?php
} else {
?>
    <script>
        alert('Error al eliminar proveedor');
        window.location = "../controller/proveedorLista.php";
    </script>
<?php
}
?>