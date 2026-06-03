<?php
$cod = $_GET['cod'];
include("../model/clienteClase.php");

$cli = new cliente($cod,"","","");
$res = $cli->activarCliente();

if($res){
?>
    <script type="text/javascript">
        alert("Cliente Activado");
        location.href="../controller/clienteListaInactivos.php";
    </script>
<?php
}else{
?>
    <script type="text/javascript">
        alert("Error al Activar Cliente");
        location.href="../controller/clienteListaInactivos.php";
    </script>
<?php
}
?>