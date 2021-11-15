<?php
if (isset($_POST['sorteo'])) {
    $db = mysqli_connect('localhost', 'root', '', 'premios');
    $value = "";
    $ganador = "";

    $resultado = mysqli_query($db, "SELECT nombre,cedula FROM usuarios ORDER BY RAND() LIMIT 1");

    $resultadoAsociativo = mysqli_fetch_assoc($resultado);

    $ganador = $resultadoAsociativo['nombre'];
    $cedulaGanador = $resultadoAsociativo['cedula'];

    echo "<script>alert('El ganador es: $ganador con la cedula $cedulaGanador')</script>";
}
?>