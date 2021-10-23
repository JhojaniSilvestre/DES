
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>

<body>
    <h1>CALCULADORA</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="operando1">Operando1:</label>
        <input type="number" name="operando1"><br><br>
        <label for="operando2">Operando2:</label>
        <input type="number" name="operando2"><br><br>
        
        <span>Selecciona operación: </span><br>
        <input type="radio" name="operacion" value="suma">
        <label for="suma">Suma</label><br>
        <input type="radio" name="operacion" value="resta">
        <label for="resta">Resta</label><br>
        <input type="radio" name="operacion" value="producto">
        <label for="producto">Producto</label><br>
        <input type="radio" name="operacion" value="division">
        <label for="division">División</label><br><br>

        <input type="submit" name="submit" value="enviar">
        <input type="reset" value="borrar">
    </form>
</body>

</html>

<?php
require 'fOperaciones1.php';

if(isset($_POST['submit'])){
    $operando1 = $_POST["operando1"];
    $operando2 = $_POST["operando2"];
    $operacion = $_POST["operacion"];
    
    //var_dump($_POST);
    echo "<br><br>";
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
}

?>
