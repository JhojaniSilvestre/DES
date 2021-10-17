<?php

//relleno el array jugadores 
$cont=0;
$carton = array();
for ($i=0; $i < 12; $i++) { //total de cartones por cada jugador, 4 jugadores cada uno con 3 cartones
    $j=0; //indice del carton Auxiliar
    $k=2; //indice donde empezarán los cartones de cada jugador
    if ($i % 3 == 0) { //controla cuantos cartones tiene un jugador
        $jugadores[$i][0] = "jugador".$cont++; //En la columna 0, el nombre del jugador
    }
    $jugadores[$i][0] = "jugador".$cont;
    $jugadores[$i][1] = 0; //en la columna 1, el contador de aciertos de cada jugador
    do{
        $numRand=rand(1,60);
        if (!in_array($numRand, $carton)) {
            $carton[$j] = $numRand; //si el numero no está, relleno el cartón para controlar que no se repitan numeros
            $jugadores[$i][$k++] =  $numRand; //relleno la columna
            $j++;
        }
    }while(count($carton) < 15); //15 numeros por cada carton
    $carton = array(); //vacio el carton para la siguiente fila
}
//var_dump($jugadores);

$bomboAux= array(); //para controlar que no se repiten los numeros del bombo
$ganadores = array();
$ganadorBingo = false;
$x=0; //posicion del array ganadores
$b=0; //posición del bombo auxiliar
while (!$ganadorBingo) {
    $bombo=rand(1,60);
    if(!in_array($bombo, $bomboAux)){
        $bomboAux[$b] = $bombo; //si el numero random del bombo no está en el auxiliar, relleno
        echo '<img src="img/'.$bombo.'.png"/>';
        for ($i = 0; $i < sizeof($jugadores); $i++) {
            for ($j = 2; $j < sizeof($jugadores[0]); $j++){ 
                if($jugadores[$i][$j] == $bomboAux[$b]){//compruebo si el numero del bombo está en la matriz
                    $jugadores[$i][1]++; //incremento el contador de aciertos del jugador
                }
            }
            if ($jugadores[$i][1] == 15) { //compruebo si un jugador ha acertado un carton entero
                $ganadorBingo = true;
                $ganadores[$x] = $jugadores[$i][0]; //relleno con su nombre el array ganadores
                $x++;
            }
        }
        $b++; // incremento la posición del bombo auxiliar
    }
}
echo "<br><br>";
//visualizar ganadores
for ($i = 0; $i < sizeof($ganadores); $i++) {
    echo "El ganador es: $ganadores[$i] <br>";
}

//visualizar la matriz
echo "<br>";
for ($i = 0; $i < sizeof($jugadores); $i++) {
    for ($j = 0; $j < sizeof($jugadores[0]); $j++){
        echo $jugadores[$i][$j]."\n|";
    }
    echo "<br>";
}

?>
