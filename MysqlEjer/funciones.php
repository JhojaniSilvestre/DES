<?php

function limpiar($dato){
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

function crear_conexion(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot"; 
    $dbname="empleados1n";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=empleados1n",$username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $conn; 
    }
    catch(PDOException $e){
        echo "Conexión fallida: " . $e->getMessage();
    }
}

function cerrar_conexion($conn){
    $conn = null;
}

?>