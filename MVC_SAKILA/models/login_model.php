<?php
//la conexion viene ya dada desde index y pasada por controller

function loginUsuario($conn,$usuario,$clave){
    try {
        $stmt = $conn->prepare("SELECT email, last_name FROM customer
        WHERE email='$usuario' AND last_name='$clave'");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

?>