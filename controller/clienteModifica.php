<?php
include("../model/clienteClase.php");

// ID viene por POST (si se envía) o GET (para mostrar el formulario)
$cod = isset($_POST['cod']) ? intval($_POST['cod']) : (isset($_GET['cod']) ? intval($_GET['cod']) : 0);

$cli = new Cliente($cod, "", "", "");

// Si viene POST, actualizamos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
    $rs = htmlspecialchars($_POST['razon'], ENT_QUOTES, 'UTF-8');
    $ni = htmlspecialchars($_POST['nit'], ENT_QUOTES, 'UTF-8');

    $r = $cli->editarCliente($cod, $rs, $ni);

    if ($r) {
        echo "<script>
            alert('Cliente modificado correctamente');
            location.href='../controller/clienteLista.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('No se modificó');
            location.href='../controller/clienteLista.php';
        </script>";
        exit();
    }
}

// Obtenemos el registro para la vista
$res = $cli->listarClienteId();

include("../view/clienteModifica.php");
