<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../model/empleadoClase.php");

if (isset($_POST['buscar'])) {

    $busqueda = $_POST['buscar'];

    $emp = new Empleado("", "", "", "", "", "", "", "", "", "", "");
    $resultado = $emp->buscarEmpleado($busqueda);

    // 🔥 DEVOLVER HTML
    if ($resultado && count($resultado) > 0) {

        foreach ($resultado as $e) {

            $id = (int)$e['id_empleado'];
            $cargo = htmlspecialchars($e['cargo'] ?? '', ENT_QUOTES, 'UTF-8');
            $ci = htmlspecialchars($e['ci'] ?? '', ENT_QUOTES, 'UTF-8');
            $nombre = htmlspecialchars(($e['nombre'] ?? '') . " " . ($e['paterno'] ?? '') . " " . ($e['materno'] ?? ''), ENT_QUOTES, 'UTF-8');
            $direccion = htmlspecialchars($e['direccion'] ?? '', ENT_QUOTES, 'UTF-8');
            $telefono = htmlspecialchars($e['telefono'] ?? '', ENT_QUOTES, 'UTF-8');
            $fecha = htmlspecialchars($e['fechanacimiento'] ?? '', ENT_QUOTES, 'UTF-8');
            $genero = htmlspecialchars($e['genero'] ?? '', ENT_QUOTES, 'UTF-8');
            $intereses = htmlspecialchars($e['intereses'] ?? '', ENT_QUOTES, 'UTF-8');

            echo "<tr>
                    <td>$id</td>
                    <td>$cargo</td>
                    <td>$ci</td>
                    <td>$nombre</td>
                    <td>$direccion</td>
                    <td>$telefono</td>
                    <td>$fecha</td>
                    <td>$genero</td>
                    <td>$intereses</td>
                    <td>
                        <a href='../controller/empleadoModifica.php?cod=$id' class='btn btn-primary btn-sm'>Editar</a>
                        <a href='../controller/empleadoEliminar.php?cod=$id' class='btn btn-danger btn-sm'>Eliminar</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No existen resultados</td></tr>";
    }

    exit;
}

// si entra normal
include("../view/empleadoBusqueda.php");
