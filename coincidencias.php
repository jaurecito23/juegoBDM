<?php

include "funciones/database.php";
include "funciones/debuguear.php";

$db = conectarDB();

session_start();

$id= $_SESSION ["id"];
$id=intval($id);

$day = date("l");
    $dia = "";

    $dias = [
        "Monday" =>"Lunes",
        "Tuesday" =>"Martes",
        "Wednesday" =>"Miercoles",
        "Thursday"=>"Jueves",
        "Friday"=>"Viernes",
        "Saturday"=>"Sabado",
        "Sunday"=>"Domingo"
    ];

    foreach ($dias as $key => $value) {

        if($key == $day){

            $dia = $value;

        }

    }

$query = "SELECT * FROM users WHERE id='${id}'";
$resultado = mysqli_query($db,$query);

$apodo = "";

foreach ($resultado as $user){

    $apodo = $user["apodo"];
    $imagen = $user["imagen"];

}



$query = "SELECT * FROM respuestas WHERE usuarioId = '${id}' AND dia ='${dia}';" ;



$resultado = mysqli_query($db,$query);

if($resultado -> num_rows == 0){

    header("Location: noparticipo.php");

}





$grupo ="";

foreach ($resultado as $respuestas ) {

    $grupo = $respuestas["grupo"];

}


$query = "SELECT * FROM grupos_${dia} WHERE grupo = '${grupo}';";
$resultado = mysqli_query($db,$query);

$cantidad = "";

foreach ($resultado as $group) {
    $cantidad = $group["cantidad"];
}



$cantidad -= 1;
include "header3.php";

?>

<main class='main'>
    <div class="contenido__main">


        <h3 class="texto">Las nuevas preguntas estarán disponibles desde las 8:00 hs.</h3>


            </div>


        </div>
</main>


<?php include "footer.php"?>


</body>
</html>