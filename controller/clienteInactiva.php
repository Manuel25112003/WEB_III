<?php
$cod = $_GET['cod'];
include("../model/clienteClase.php");

$cli = new cliente($cod,"","","");
$res = $cli->inactivarCliente();

if($res){
?>
    <script type="text/javascript">
        alert("Cliente Inactivado");
        location.href="../controller/clienteListaInactivos.php";
    </script>
<?php
}else{
?>
    <script type="text/javascript">
        alert("Error al Inactivar Cliente");
        location.href="../controller/clienteListaInactivos.php";
    </script>
<?php
}
?>