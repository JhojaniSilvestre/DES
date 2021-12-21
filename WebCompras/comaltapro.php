<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Dar de alta Producto</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="nom_pro">Nombre del producto:</label>
        <input type="text" name="nom_pro"><br><br>
        <label for="precio_pro">Precio:</label>
        <input type="number" name="precio_pro" min="0" value="0" step=".01"><br><br>
        <label for="cat_pro">Categoría:</label>
        <select name="cat_pro">
            <?php require_once 'conexion.php'; require_once 'funciones_com.php';
                $conn = crear_conexion();
                //compruebo que el form no ha sido enviado
                if (!isset($_POST) || empty($_POST)) {
                    //devuelve un array con el nombre de las categorias
                    $categorias = obtener_categorias($conn);
				}
            ?>
            <!--recorro el array imprimiendo la categoria -->
            <?php foreach($categorias as $id_cat => $categoria) : ?>
                <?php echo "<option value='".$id_cat."'>".$categoria."</option>"; ?>
            <?php endforeach; cerrar_conexion($conn);?>
        </select>
        <input type="submit" name="submit" value="enviar">
    </form>
<?php //una vez que el form ha sido enviado
        if(isset($_POST["submit"])){

            $nom_pro = limpiar($_POST["nom_pro"]);
            $precio_pro = limpiar($_POST["precio_pro"]);
            $cat_pro = limpiar($_POST["cat_pro"]);

            $conn = crear_conexion();

            $cod = generarCodPro($conn);
            insertarProducto($conn,$cod,$nom_pro,$precio_pro,$cat_pro);

            cerrar_conexion($conn);
        }

/*
Alta de Productos (comaltapro.php): dar de alta productos. Para seleccionar la categoría del
producto, se utilizará una lista de valores con los nombres de las categorías. El id_producto
será un campo con el formato Pxxxx donde xxxx será un número secuencial que comienza en
1 completándose con 0 hasta completar el formato.
*/
?>
</body>
</html>





