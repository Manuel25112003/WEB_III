<?php
// Mostrar todos los errores para desarrollo (desactivar en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../model/cargoClase.php");

// Verificamos si se envió el formulario
if (isset($_POST['registrarCargo'])) {

    // Sanitizamos el dato recibido
    $ca = trim($_POST['cargo']);

    if (empty($ca)) {
        echo "<script>
                alert('El campo Cargo no puede estar vacío');
              </script>";
    } else {
        try {
            $car = new Cargo("", $ca);

            $r = $car->grabarCargo();

            if ($r) {
                echo "<script>
                        alert('Cargo registrado correctamente');
                        window.location = '../controller/cargoLista.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('No se pudo registrar el cargo. Intente nuevamente');
                      </script>";
            }
        } catch (PDOException $e) {
            echo "<script>
                    alert('Error al registrar cargo: " . addslashes($e->getMessage()) . "');
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Ocurrió un error inesperado: " . addslashes($e->getMessage()) . "');
                  </script>";
        }
    }
}

// Incluimos la vista del registro
include("../view/cargoRegistro.php");
