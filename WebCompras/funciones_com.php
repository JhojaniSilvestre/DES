<?php
/*----------------------------------------------------------alta categoria*/
function generarCodCat($conn){
    try {
        $stmt = $conn->prepare("SELECT MAX(ID_CATEGORIA) AS maxcat FROM categoria");
        $stmt->execute();
    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
            $max = $row["maxcat"];
        }
        $cod = substr($max, -3); //extraigo los 3 ultimos caracteres del codigo
        //son números por lo que lo que se eliminan los 0: 001 -> 1
        $cod++; //incremento en 1 C-xxx
        $str_cod = str_pad($cod,3,"0",STR_PAD_LEFT);
        $cod = "C-".$str_cod;
        return $cod; //devuelvo el código para el nuevo dpto
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function insertarCategoria($conn,$cod,$nom_cat){
    try {
        $sql = "INSERT INTO categoria (ID_CATEGORIA,NOMBRE) VALUES ('$cod','$nom_cat')";
        
        $conn->exec($sql);
        echo "Nueva categoría creada exitosamente!";
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}
/*----------------------------------------------------------alta producto*/
function generarCodPro($conn){
    try {
        $stmt = $conn->prepare("SELECT MAX(ID_PRODUCTO) AS maxpro FROM producto");
        $stmt->execute();
    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
            $max = $row["maxpro"];
        }
        $cod = substr($max, -4); //extraigo los 4 ultimos caracteres del codigo
        //son números por lo que lo que se eliminan los 0: 0001 -> 1
        $cod++; //incremento en 1 Pxxxx
        $str_cod = str_pad($cod,4,"0",STR_PAD_LEFT);
        $cod = "P".$str_cod;
        return $cod; //devuelvo el código para el nuevo product

    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function obtener_categorias($conn){
    try {
        $stmt = $conn->prepare("SELECT ID_CATEGORIA,NOMBRE FROM categoria");
        $stmt->execute(); //ejecuta la select

        //modo de obtención -> array indexado
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //obtiene todas las filas del array
        foreach($stmt->fetchAll() as $row) {
            //guardo los nombres obtenidos en un array
            $id_cat = $row["ID_CATEGORIA"];
            $categorias["$id_cat"] = $row["NOMBRE"]; 
        }
        return $categorias; //devuelvo el array con los nombres 
        
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function insertarProducto($conn,$cod,$nom_pro,$precio_pro,$cat_pro){
    try {
        $sql = "INSERT INTO producto (ID_PRODUCTO,NOMBRE,PRECIO,ID_CATEGORIA) 
        VALUES ('$cod','$nom_pro','$precio_pro','$cat_pro')";
        
        $conn->exec($sql);
        echo "Nuevo producto creado exitosamente!";
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}
/*----------------------------------------------------------alta almacen*/
function generarCodAlm($conn){
    try {
        $stmt = $conn->prepare("SELECT MAX(NUM_ALMACEN) AS maxalm FROM almacen");
        $stmt->execute();
    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
            $max = $row["maxalm"];
        }
        $cod = $max + 10;
        
        return $cod; //devuelvo el código para el nuevo almacen
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function insertarAlmacen($conn,$cod,$loc_alm){
    try {
        $sql = "INSERT INTO almacen (NUM_ALMACEN,LOCALIDAD) 
        VALUES ('$cod','$loc_alm')";
        //use exec() because no results are returned
        $conn->exec($sql);
        echo "Nuevo almacen creado exitosamente!";
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

/*----------------------------------------------------------aprov almacen*/

function obtenerNumAlm($conn){
    try {
        $stmt = $conn->prepare("SELECT NUM_ALMACEN FROM almacen");
        $stmt->execute();
    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
            $almacenes[] = $row["NUM_ALMACEN"];
        }
        return $almacenes; //devuelvo un array con el num de todos los almacenes
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function obtener_productos($conn){ 
    try {
        $stmt = $conn->prepare("SELECT ID_PRODUCTO,NOMBRE FROM producto");
        $stmt->execute(); //ejecuta la select

        //modo de obtención -> array indexado
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //obtiene todas las filas del array
        foreach($stmt->fetchAll() as $row) {
            //guardo los nombres obtenidos en un array
            $id_pro = $row["ID_PRODUCTO"];
            $productos["$id_pro"] = $row["NOMBRE"]; 
        }
        return $productos; //devuelvo el array con los nombres 
        
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
//realizar update o insert para productos ya existentes
function aprov_productos($conn,$num_alm,$id_pro,$cantidad){
    try {
        $stmt = $conn->prepare("SELECT NUM_ALMACEN,ID_PRODUCTO FROM almacena WHERE NUM_ALMACEN = '$num_alm'
        AND ID_PRODUCTO='$id_pro'");
        $stmt->execute(); //uso execute porque devuelve resultados, en este caso de la select
//con el resultado obtenido compruebo si devuelve un resultado para hacer update o insertar
        if ($stmt->rowCount() > 0) {
            $update = "UPDATE almacena SET CANTIDAD = CANTIDAD + $cantidad 
            WHERE NUM_ALMACEN= $num_alm AND ID_PRODUCTO='$id_pro'";
            $conn->exec($update); //uso exec() porque no devuelve resultados, solo ejecuta
            echo "Lista de aprovisionamiento actualizado correctamente";
        } else {
            $insert = "INSERT INTO almacena (NUM_ALMACEN,ID_PRODUCTO,CANTIDAD) 
            VALUES ('$num_alm','$id_pro','$cantidad')";
            $conn->exec($insert);
            echo "Nuevo registro insertado en la lista de aprovisionamiento";
        }
    }
    catch(PDOException $e){
        echo $stmt . "<br>" . $e->getMessage();
    }
}


/*----------------------------------------------------------consultar stock products*/


function consult_stock_pro($conn,$id_pro){
    try {
        $stmt = $conn->prepare("SELECT NUM_ALMACEN,CANTIDAD FROM almacena WHERE ID_PRODUCTO = '$id_pro'");
        $stmt->execute();
    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
            echo "ALMACEN: ".$row["NUM_ALMACEN"]." CANTIDAD: ".$row["CANTIDAD"]."<br><br>";
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

/*----------------------------------------------------------consultar Almacenes*/

function consult_pro_alm($conn,$num_alm){
    try {
        $stmt = $conn->prepare("SELECT producto.ID_PRODUCTO, producto.NOMBRE, PRECIO, producto.ID_CATEGORIA 
        FROM almacena, producto, categoria 
        WHERE almacena.ID_PRODUCTO = producto.ID_PRODUCTO 
        AND producto.ID_CATEGORIA = categoria.ID_CATEGORIA 
        AND NUM_ALMACEN='$num_alm'");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        echo "<table border=1>";
        echo "<tr><th>ID_PRODUCTO</th><th>NOMBRE</th><th>PRECIO</th><th>ID_CATEGORIA</th></tr>";
        foreach($stmt->fetchAll() as $row) {
            echo "<tr>";
            echo "<td>".$row["ID_PRODUCTO"]."</td><td>".$row["NOMBRE"]."</td><td>".$row["PRECIO"]."</td><td>".$row["ID_CATEGORIA"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

/*----------------------------------------------------------consulta compras*/

function obtenerNif($conn){
    try {
        $stmt = $conn->prepare("SELECT NIF FROM cliente");
        $stmt->execute();
    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
            $clientes[] = $row["NIF"];
        }
        return $clientes; //devuelvo un array con el nif de todos los clientes
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function consult_com_cli($conn,$nif,$f_desde,$f_hasta){
    try {//producto, nombre producto, precio compra
        $stmt = $conn->prepare("SELECT compra.ID_PRODUCTO, producto.NOMBRE, producto.PRECIO
        FROM compra, producto
        WHERE producto.ID_PRODUCTO = compra.ID_PRODUCTO
        AND compra.NIF = '$nif' AND FECHA_COMPRA BETWEEN '$f_desde' AND '$f_hasta'");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            echo "<table border=1>";
            echo "<tr><th>ID_PRODUCTO</th><th>NOMBRE</th><th>PRECIO</th></tr>";
            foreach($stmt->fetchAll() as $row) {
                echo "<tr>";
                echo "<td>".$row["ID_PRODUCTO"]."</td><td>".$row["NOMBRE"]."</td><td>".$row["PRECIO"]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else{
            echo "No se encontró ningun registro entre las fechas seleccionadas.";
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function total_compras_cli($conn,$nif,$f_desde,$f_hasta){
    try {//producto, nombre producto, precio compra
        $stmt = $conn->prepare("SELECT SUM(producto.PRECIO * compra.UNIDADES) AS TOTAL
        FROM compra, producto
        WHERE producto.ID_PRODUCTO = compra.ID_PRODUCTO AND NIF = '$nif'
        AND FECHA_COMPRA BETWEEN '$f_desde' AND '$f_hasta'");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        echo "<table border=1>";
        echo "<tr><th>TOTAL</th></tr>";
        foreach($stmt->fetchAll() as $row) {
            echo "<tr><th>".$row["TOTAL"]."</th><tr>";
        }
        echo "</table>";

    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


/*----------------------------------------------------------- Validar alta cliente*/

function validarNIF($nif){
    $valido = true;
    $largo = strlen($nif);
    try {
        if ($nif == "") {
            $valido = false;
            throw new Exception("NIF es un campo obligatorio");
        }
        elseif ($largo > 9 || $largo < 9) {
            $valido = false;
            throw new Exception("Longitud incorrecta del NIF, deben ser 8 dígitos más una letra");
        }
        elseif ($largo == 9) {
            $digitos = substr($nif, 0, -1);
            $letra = substr($nif, -1);
            if (!preg_match("/^[0-9]+$/", $digitos) || !preg_match("/^[A-Za-z]+$/", $letra)) {
                $valido = false;
                throw new Exception("NIF incorrecto, deben ser 8 dígitos y por último una letra");
            }
        }

        return $valido;
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

function altaCliente($conn,$nif,$nombre,$apellido,$cp,$direccion,$ciudad){
    try {
        $stmt = $conn->prepare("SELECT NIF FROM cliente
        WHERE NIF = '$nif'");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            throw new Exception("El NIF introducido ya existe!");
        }
        else{
            $insert = "INSERT INTO cliente (NIF,NOMBRE,APELLIDO,CP,DIRECCION,CIUDAD) 
            VALUES ('$nif','$nombre','$apellido','$cp','$direccion','$ciudad')";
            $conn->exec($insert);
            echo "Se dio de alta al cliente exitosamente!";
        }
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

/*----------------------------------------------------------- Validar alta cliente*/

function comprobarStockPro($conn,$nif,$id_pro,$cantidad){
    try {
        $stmt = $conn->prepare("SELECT NUM_ALMACEN, MAX(CANTIDAD) AS STOCK FROM almacena
        WHERE ID_PRODUCTO = '$id_pro'");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt->fetchAll() as $row) {
                $stock = $row["STOCK"];
                $num_alm = $row["NUM_ALMACEN"];    
            }

            if ($cantidad > $stock) {
                throw new Exception("No hay suficiente stock del producto para la cantidad solicitada");
            }
            else{
                $update = "UPDATE almacena SET CANTIDAD = CANTIDAD - $cantidad 
                WHERE NUM_ALMACEN= $num_alm AND ID_PRODUCTO='$id_pro'";
                $conn->exec($update); //uso exec() porque no devuelve resultados, solo ejecuta
                
                date_default_timezone_set('Europe/Madrid'); //establece la zona horaria
                //obtenemos la fecha actual (año,mes,dia,hora,min,seg)
                $fecha_compra = date('Y-m-d');

                $insert = "INSERT INTO compra (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES)
                VALUES ('$nif','$id_pro','$fecha_compra',$cantidad)";
                $conn->exec($insert);
                echo "compra realizada exitosamente";
            }
        }
        else{
            throw new Exception("No se encontró el producto seleccionado");   
        }
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}


/*------------------------------------------REGISTRO USUARIO*/

function registrarUsuario($conn,$usuario,$clave){
    try {
        $sql = "INSERT INTO USUARIO (ID_USUARIO,NOMBRE,CLAVE) VALUES (NULL,'$usuario','$clave')";
        
        if($conn->exec($sql)){
            $mensaje = "se ha registrado correctamente!";
        }
        else{
            $mensaje = "Ha ocurrido un error al registrarse";
        }
        return $mensaje;
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

/*------------------------------------------LOGIN USUARIO*/

function loginUsuario($conn,$usuario,$clave){
    try {
        $stmt = $conn->prepare("SELECT ID_USUARIO, NOMBRE, CLAVE FROM USUARIO
        WHERE NOMBRE = '$usuario'");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        //$count = count($resultado);

        $mensaje = "";

        if ( count($resultado) > 0 && password_verify($clave, $resultado["CLAVE"])) {
            // Se crea sesión y variables de sesión
            session_start();
            $_SESSION['login_usuario'] = $resultado["NOMBRE"];
            $_SESSION['id_usuario'] = $resultado["ID_USUARIO"];
               
            header("location: comwelcome.php");
        }
        else // Si no, el usuario/contraseña no son correctos y por tanto no se loguea al cliente -> muestra mensaje de error
        { 
            $mensaje = "Usuario o contraseña incorrectos !!!";
            
        }

        return $mensaje;
    
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

?>