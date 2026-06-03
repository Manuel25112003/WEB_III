<?php

$cod = $_GET['cod'];

include("../model/cargoClase.php");

$car = new Cargo($cod,"");

$res = $car->eliminarCargo();

if($res){
?>

<script>

alert("Cargo eliminado correctamente");
location.href="../controller/cargoLista.php";

</script>

<?php
}else{
?>

<script>

alert("Error al eliminar cargo");
location.href="../controller/cargoLista.php";

</script>

<?php
}
?>