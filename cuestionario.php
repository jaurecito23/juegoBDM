<?php

    require "funciones/database.php";
    require "funciones/debuguear.php";

   $db = conectarDB();

   session_start();
    $id = $_SESSION["id"];




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



    //Traer apodo

    $query = "SELECT * FROM users WHERE id = ${id} LIMIT 1";
    $resultado = mysqli_query($db,$query);



    $apodo = "";
    $imagen = "";
    $yarespodio = "";



    foreach($resultado as $user){
        $apodo = $user["apodo"];
        $imagen= $user["imagen"];
        $yarespondio = $user["yarespondio"];

    }

    if($yarespondio == $dia){

        header("Location: findia.php");

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

    $sigla ="";

    foreach ($respuestas as $respuesta) {

        $sigla .= $respuesta;

    }


        $query = "INSERT INTO respuestas (usuarioId,grupo,dia) VALUES('${id}','${sigla}','${dia}');";

        $resultado = mysqli_query($db,$query);

        if($resultado){
            $query = "UPDATE users SET yarespondio='${dia}' WHERE id='${id}'";
            $resultado = mysqli_query($db,$query);
            header("Location: findia.php");

        }




  }

}



include "header2.php";
?>

<main class="main">

    <div class="contenedor__form">
        <form data-total=<?php echo $cantDePreg?> class="form" method="POST">
            <?php foreach($preguntas as $pregunta):?>

            <div id=<?php echo $numPreg ?> class="<?php if($numPreg != "1"){echo "oculto";};?> contenido__form">
                <h2 class="titulo dia"><?php echo $dia?></h2>


                <fieldset>
                    <div class="form__respuesta">

                        <div class="pregunta-proceso">
                        <label class="proceso"><?php echo $numPreg?>/<?php echo $cantDePreg?></label>

                        <h2 class="titulo"> <?php echo $pregunta; ?></h2>
                       </div>
                        <div class="inputs__respuestas">
                            <div class="input-respuesta">
                                <input id="<?php echo $numPreg?>A" class="respuesta" value="A" name="respuestas[<?php echo $numPreg ?>]" type="radio">
                                 <label for="<?php echo $numPreg?>A" class="texto"> <?php  $numP = $numPreg - 1; echo $opciones[$numP][0] ?> </label>
                           </div>

                            <div class="input-respuesta">
                                <input  id="<?php echo $numPreg?>B" class="respuesta" value="B" name="respuestas[<?php echo $numPreg ?>]" type="radio">
                                <label for="<?php echo $numPreg?>B" class="texto"> <?php  $num = $numPreg - 1; echo $opciones[$numP][1] ?> </label>
                            </div>
                        </div>
                    </div>

                </fieldset>


                <button class="btn siguiente btn<?php echo $numPreg?> oculto" type="button">Siguiente</button>
            </div>
            <?php $numPreg += 1 ?>
            <?php endforeach?>
            <input class="btn btn-enviar oculto" type="submit" value="Enviar">
        </form>
    </div>
</main>

<?php include "footer.php"?>


<script src="build/js/bundle.min.js"></script>
</body>


</html>