<?php

include("../model/cargoClase.php");

$car = new Cargo("","");

$res = $car->listarCargo();

include("../view/cargoLista.php");

?>