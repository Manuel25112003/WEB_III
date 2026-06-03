<?php
include("../view/clienteRegistro.php");
if(isset($_POST['registrarCliente'])){
    $ni = $_POST['nit'];
    $rs = $_POST['razon'];
    $es = "Activo";
    include("../model/clienteClase.php");
    $cli=new Cliente("",$ni,$rs,$es);
    $r=$cli->grabarCliente();
    if($r){
        ?>
        <script type="text/javascript">
        alert('Cliente registrado correctamente');
        window.location="../controller/clienteLista.php";
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
        alert('Error al registrar cliente');
        </script>
        <?php
    }
}
?>