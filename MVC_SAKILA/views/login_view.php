<html>
   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title> <!--se usan las rutas como si estuviera en index-->
    <link rel="stylesheet" href="views/css/bootstrap.min.css">
 </head>
      
<body>

    <h1>MOVILMAD</h1>

<!--     <?php //if (!empty($mensaje)): ?>
        <br><p><?php// echo $mensaje; ?></p>
    <?php //endif; ?> -->

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Login Usuario</div>
		<div class="card-body">
		<!--Se manda a sí mismo, en este caso index la raiz, este lo redijirá a controller-->
		<form id="" name="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="card-body">
		
		<div class="form-group">
			Email <input type="text" name="email" placeholder="email" class="form-control">
        </div>
		<div class="form-group">
			Clave <input type="password" name="password" placeholder="password" class="form-control">
        </div>				
        
		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>
		
	    </div>
    </div>
    </div>
    </div>

</body>
</html>