<?php
    include("../model/clienteClase.php");
    $cli=new Cliente("","","","");
    $resultado=$cli->listarClienteInactivo();
    include("../view/clienteListaInactivos.php");
?>