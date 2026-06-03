<?php
    include("../model/clienteClase.php");
    $cli=new Cliente("","","","");
    $resultado=$cli->listarCliente();
    include("../view/clienteLista.php");
?>
