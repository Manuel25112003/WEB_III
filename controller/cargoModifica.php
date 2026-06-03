<?php
include("../model/cargoClase.php");

// ID viene por POST (si se envía) o GET (para mostrar el formulario)
$cod = isset($_POST['cod']) ? intval($_POST['cod']) : (isset($_GET['cod']) ? intval($_GET['cod']) : 0);

$car = new Cargo($cod, "");

// Si viene POST, actualizamos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
    $ca = htmlspecialchars($_POST['cargo'], ENT_QUOTES, 'UTF-8');
    $r = $car->editarCargo($cod, $ca);

    if ($r) {
        echo "<script>
            alert('Cargo modificado correctamente');
            location.href='../controller/cargoLista.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('No se modificó');
            location.href='../controller/cargoLista.php';
        </script>";
        exit();
    }
}

// Obtenemos el registro para la vista
$res = $car->listarCargoId();

include("../view/cargoModifica.php");
