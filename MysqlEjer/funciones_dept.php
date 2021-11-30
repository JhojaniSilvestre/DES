<?php

function alta_departamento($nombre_dept,$conn){
    try {
        $sql = "INSERT INTO departamento (nombre_d) VALUES ('$nombre_dept')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Nuevo departamento creado exitosamente!";
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

?>