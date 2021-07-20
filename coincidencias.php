<?php

include "funciones/database.php";
include "funciones/debuguear.php";

$db = conectarDB();

$id=$_GET["id"];
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

}



$query = "SELECT * FROM respuestas WHERE usuarioId = '${id}' AND dia ='${dia}';" ;



$resultado = mysqli_query($db,$query);



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
include "header.php";
?>

<main class='main'>
    <div class="contenido__main">

        <h2 class='hola'> Hola <?php echo $apodo ?>! </h2>

        <div class="contenedor_foto">
            <img src="#">
            <div class="coincidencias">

                <h2><?php echo $cantidad ?> coincidencias </h2>

            </div>
            <h3> Las preguntas estaran dsiponible desde las 8hs</h3>

            <button class='btn'> Siguiente </button>
        </div>
</main>


<?php include "footer.php"?>


</body>
</html>