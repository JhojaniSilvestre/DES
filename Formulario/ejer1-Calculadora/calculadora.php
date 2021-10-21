<?php
require 'fOperaciones.php';

$operando1 = $_POST["operando1"];
$operando2 = $_POST["operando2"];
$operacion = $_POST["operacion"];

var_dump($_POST);

if ($operacion == "suma") {
    $resultado = Suma($operando1, $operando2);
    echo "Resultado operación: ".$operando1." + ".$operando2."=".$resultado;
}
elseif ($operacion == "resta") {
    $resultado = Resta($operando1, $operando2);
    echo "Resultado operación: ".$operando1." - ".$operando2."=".$resultado;
}
elseif ($operacion == "producto") {
    $resultado = Producto($operando1, $operando2);
    echo "Resultado operación: ".$operando1." * ".$operando2."=".$resultado;
}
elseif ($operacion == "division") {
    $resultado = Division($operando1, $operando2);
    if ($resultado == -1) {
        echo "Error división por 0";
    }
    else{
        echo "Resultado operación: ".$operando1." / ".$operando2."=".$resultado;
    }
}

?>
