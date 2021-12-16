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
        
        if ($cod < 10) { //hasta 9
            $cod = "C-00".$cod;
        }
        elseif ($cod < 100) { //hasta 99
            $cod = "C-0".$cod;
        }
        elseif ($cod < 1000) { //hasta 999
            $cod = "C-".$cod;
        }
        
        return $cod; //devuelvo el código para el nuevo dpto
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function insertarCategoria($conn,$cod,$nom_cat){
    try {
        $sql = "INSERT INTO categoria (ID_CATEGORIA,NOMBRE) VALUES ('$cod','$nom_cat')";
        // use exec() because no results are returned
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
        
        if ($cod < 10) { //hasta 9
            $cod = "P000".$cod;
        }
        elseif ($cod < 100) { //hasta 99
            $cod = "P00".$cod;
        }
        elseif ($cod < 1000) { //hasta 999
            $cod = "P0".$cod;
        }
        elseif ($cod < 10000) { //hasta 9999
            $cod = "P".$cod;
        }
        
        return $cod; //devuelvo el código para el nuevo dpto
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function obtener_categorias($conn){
    try {
        $stmt = $conn->prepare("SELECT NOMBRE FROM categoria");
        $stmt->execute(); //ejecuta la select

        //modo de obtención -> array indexado
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //obtiene todas las filas del array
        foreach($stmt->fetchAll() as $row) {
            //guardo los nombres obtenidos en un array
            $categorias[] = $row["NOMBRE"]; 
        }
        return $categorias; //devuelvo el array con los nombres 
        
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function codCat_de_NomCat($conn,$cat_pro){
    try {
        $stmt = $conn->prepare("SELECT ID_CATEGORIA FROM categoria WHERE NOMBRE = '$cat_pro' ");
        $stmt->execute(); //ejecuta la select

        //modo de obtención -> array indexado
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //obtiene todas las filas del array
        foreach($stmt->fetchAll() as $row) {
            $cod_cat = $row["ID_CATEGORIA"]; 
        }
        return $cod_cat; 
        
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function insertarProducto($conn,$cod,$nom_pro,$precio_pro,$codCat){
    try {
        $sql = "INSERT INTO producto (ID_PRODUCTO,NOMBRE,PRECIO,ID_CATEGORIA) 
        VALUES ('$cod','$nom_pro','$precio_pro','$codCat')";
        // use exec() because no results are returned
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
        
        return $cod; //devuelvo el código para el nuevo dpto
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function insertarAlmacen($conn,$cod,$loc_alm){
    try {
        $sql = "INSERT INTO almacen (NUM_ALMACEN,LOCALIDAD) 
        VALUES ('$cod','$loc_alm')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Nuevo almacen creado exitosamente!";
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

?>