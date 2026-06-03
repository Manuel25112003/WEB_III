<?php
$cod = $_GET['cod'];
include("../model/clienteClase.php");

$cli = new cliente($cod,"","","");
$res = $cli->eliminarCliente();

if($res){
?>
    <script type="text/javascript">
        alert("Cliente Eliminado de la base de datos");
        location.href="../controller/clienteListaInactivos.php";
    </script>
<?php
}else{
?>
    <script type="text/javascript">
        alert("Error al Eliminar Cliente");
        location.href="../controller/clienteListaInactivos.php";
    </script>
<?php
}
?>