<?php

    require "funciones/database.php";
    require "funciones/debuguear.php";

   $db = conectarDB();


    $preguntas = [];
    $numPreg = 1;
    $day = date("l");
    $dia = "";
    $cantDePreg = 0;
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


    // Traer Preguntas

    $query = "SELECT * FROM preguntas WHERE  dia = '${dia}';";

    $resultado = mysqli_query($db,$query);

if($resultado){
    foreach ($resultado as $pregunta) {

        $preguntas[] = $pregunta["pregunta"];
        $cantDePreg += 1;
  }

// Traer las opciones

// Arreglo de opciones 
$opciones = [];

// Seleccionar de la base de datos
  $query="SELECT * FROM opciones WHERE dia='${dia}';";
    $resultado = mysqli_query($db,$query);


    foreach($resultado as $opcion){
        

        //Selecciona las respuestas de la base de datos 
        $opciones12 = [];
        $opciones12[] = $opcion["opcion1"]; 
        $opciones12[] = $opcion["opcion2"];
        $opciones[] = $opciones12;

    }



  if($_SERVER['REQUEST_METHOD']==="POST"){

    $respuestas = $_POST['respuestas'];

    foreach($respuestas as $respuestas) {



    }

  }

}



include "header.php";
?>

<main class="main">

    <div class="contenedor__form">
        <form data-total=<?php echo $cantDePreg?> class="form" action="index.php" method="POST">
            <?php foreach($preguntas as $pregunta):?>

            <div id=<?php echo $numPreg ?> class="oculto  contenido__form">
                <h2>Hoy es <?php echo $dia?></h2>
                <h3> Proceso : <?php echo $numPreg?>/<?php echo $cantDePreg?> </h3>
             
                <fieldset>
                    <div class="form__respuesta">
                        <label> Pregunta <?php echo $numPreg?>:</label>
                        <h2> <?php echo $pregunta?></h2>
                        <div class="inputs__respuestas">
                            <label> <?php  $num = $numPreg - 1; echo $opciones[$numP][0] ?> </label>
                            <input class="respuesta" value="si" name="respuestas[<?php echo $numPreg ?>]" type="radio">
                            <label> <?php  $num = $numPreg - 1; echo $opciones[$numP][1] ?> </label>
                            <input class="respuesta" value="no" name="respuestas[<?php echo $numPreg ?>]" type="radio">
                        </div>
                    </div>

                </fieldset>


                <button class="siguiente btn<?php echo $numPreg?> oculto" type="button">Siguiente</button>
            </div>
            <?php $numPreg += 1 ?>
            <?php endforeach?>
            <input class="btn-enviar oculto" type="submit" value="Enviar">
        </form>
    </div>
</main>

<script src="app.js"></script>
</body>


</html>