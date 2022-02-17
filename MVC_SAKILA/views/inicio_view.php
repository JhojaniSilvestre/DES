<?php
    //la sesión ya está iniciada desde login controller

    //si el usuario se ha logueado, se muestra contenido
    if(isset($_SESSION['usuario'])){ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<br><p><?php echo "Bienvenido/a: ".$_SESSION['clave']; ?></p>
<!--para cerrar redirijo a index que es la raiz, eso llevará al login controller para cerrar sesión-->
<BR><a href="index.php">Cerrar Sesión</a>

<?php //sino se ha logueado, se muestra mensaje
      } else{
         // header("location: login_view.php");
         echo "necesitas loguearte";
      }
      
?>
<!--Si el mensaje contiene algun error-->
<?php if (!empty($mensaje)): ?>
    <br><p><?php echo $mensaje; ?></p>
<?php endif; ?>

</body>
</html>