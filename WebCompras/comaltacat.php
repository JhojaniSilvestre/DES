<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Dar de alta categoria de producto</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="nom_cat">Nombre categoria:</label>
        <input type="text" name="nom_cat"><br><br>
        <input type="submit" name="submit" value="enviar">
    </form>
<?php //una vez que el form ha sido enviado
        if(isset($_POST["submit"])){
            require 'conexion.php'; require 'funciones_com.php';
            $nom_cat = limpiar($_POST["nom_cat"]);

            $conn = crear_conexion();

            $cod = generarCodCat($conn);
            insertarCategoria($conn,$cod,$nom_cat);

            cerrar_conexion($conn);
        }

/*
Alta de Categorías (comaltacat.php): dar de alta categorías de productos. El id_categoria
será un campo con el formato C-xxx donde xxx será un número secuencial que comienza en 1
completándose con 0 hasta completar el formato.
*/
?>
</body>
</html>