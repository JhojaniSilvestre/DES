<?php

function obtener_Departamentos($conn){
    try {
        $stmt = $conn->prepare("SELECT nombre_dpto FROM departamento");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
            $departamentos[] = $row["nombre_dpto"];
        }
        return $departamentos;
        
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function salarioEmpDept($conn, $dept_emp){
    try {
        $stmt = $conn->prepare("SELECT nombre, salario from empleado, emple_depart, departamento
        WHERE empleado.dni = emple_depart.dni 
        AND departamento.cod_dpto = emple_depart.cod_dpto
        AND nombre_dpto = '$dept_emp' AND fecha_fin IS NULL");

        $stmt->execute();
        //modo de obtención -> array indexado
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //obtiene todas las filas del array
        foreach($stmt->fetchAll() as $row) {
            echo "Nombre: " . $row["nombre"].", Salario: ".$row["salario"]."<br>";
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function sumaSalario($conn, $dept_emp){
    try {
        $stmt = $conn->prepare("SELECT SUM(salario) as total from empleado, emple_depart, departamento
        WHERE empleado.dni = emple_depart.dni 
        AND departamento.cod_dpto = emple_depart.cod_dpto
        AND nombre_dpto = '$dept_emp' AND fecha_fin IS NULL");

        $stmt->execute();
        //modo de obtención -> array indexado
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //obtiene todas las filas del array
        foreach($stmt->fetchAll() as $row) {
            echo "Suma total salario: " . $row["total"]."<br>";
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>