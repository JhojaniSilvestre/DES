<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de productos</title>
</head>
<body>
<?php require_once 'conexion.php'; require_once 'funciones_com.php';
    $conn = crear_conexion();
    $productos = obtener_productos($conn);
    $clientes = obtenerNif($conn);
?>
    <h3>Compra de productos</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="nif">NIF Clientes:</label>
        <select name="nif">
            <!--recorro el array nif clientes -->
            <?php foreach($clientes as $nif) : ?>
                <option><?php echo $nif; ?></option>
            <?php endforeach;?>
        </select><br><br>
        <label for="id_pro">Producto:</label>
        <select name="id_pro">
            <!--recorro el array nombreProductos -->
            <?php foreach($productos as $id => $nom_pro) : ?>
                <?php echo "<option value='".$id."'>".$nom_pro."</option>"; ?>
            <?php endforeach; cerrar_conexion($conn);?>
        </select><br><br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad"><br><br>
        <input type="submit" name="submit" value="enviar"><br><br>
    </form>
    <br><a href='inicio.php'>Volver a inicio</a>
<?php //una vez que el form ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nif = limpiar($_POST["nif"]);
            $id_pro = limpiar($_POST["id_pro"]);
            $cantidad = limpiar($_POST["cantidad"]);

            $conn = crear_conexion();

            comprobarStockPro($conn,$nif,$id_pro,$cantidad);

            cerrar_conexion($conn);
        }

/*
Aprovisionar Productos (comaprpro.php): asignar una cantidad de un determinado producto
a un almacén. Se seleccionarán los nombres de los productos y los números de los almacenes
desde listas desplegables. El usuario introducirá la cantidad del producto a aprovisionar.
*/
?>
</body>
</html>