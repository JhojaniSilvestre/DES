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

?>