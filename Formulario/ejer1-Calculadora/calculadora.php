<?php
require 'fOperaciones.php';

$operando1 = $_POST["operando1"];
$operando2 = $_POST["operando2"];
$suma = $_POST["operando2"];
$resta = $_POST["resta"];
$producto = $_POST["producto"];
$division = $_POST["division"];


if ($suma != null) {
    $resultado = Suma($operando1, $operando2);
    echo "Resultado operación: ".$operando1." + ".$operando2."=".$resultado;
}
elseif ($resta !=null) {
    $resultado = Resta($operando1, $operando2);
    echo "Resultado operación: ".$operando1." - ".$operando2."=".$resultado;
}
elseif ($producto !=null) {
    $resultado = Producto($operando1, $operando2);
    echo "Resultado operación: ".$operando1." * ".$operando2."=".$resultado;
}
elseif ($division !=null) {
    $resultado = Division($operando1, $operando2);
    if ($resultado == -1) {
        echo "Error división por 0";
    }
    else{
        echo "Resultado operación: ".$operando1." / ".$operando2."=".$resultado;
    }
}

?>
