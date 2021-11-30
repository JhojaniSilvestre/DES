<?php

function alta_empleado($dni_emp,$nombre_emp,$fnac_emp,$dept_emp,$conn){
    try {
        $sql = "INSERT INTO empleado (dni, nombre_e, fec_nac, nombre_d) 
        VALUES ('$dni_emp','$nombre_emp','$fnac_emp','$dept_emp')";
    
        $conn->exec($sql);
        echo "Empleado creado exitosamente!";
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

function obtener_Departamentos($conn){
    try {
        $stmt = $conn->prepare("SELECT nombre_d FROM departamento");
        $stmt->execute();
        //modo de obtención -> array indexado
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //obtiene todas las filas del array
        foreach($stmt->fetchAll() as $row) {
            $departamentos[] = $row["nombre_d"];
        }
        return $departamentos;
        
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>