<?php
include("../model/empleadoClase.php");

// RECIBE EL ID
$id = $_GET['cod'];

// CREA OBJETO
$emp = new Empleado($id, "", "", "", "", "", "", "", "", "", "");

// EJECUTA ELIMINAR
$r = $emp->eliminarEmpleado();

if ($r) {
?>
    <script>
        alert('Empleado eliminado correctamente');
        window.location = "../controller/empleadoLista.php";
    </script>
<?php
} else {
?>
    <script>
        alert('Error al eliminar empleado');
        window.location = "../controller/empleadoLista.php";
    </script>
<?php
}
?>