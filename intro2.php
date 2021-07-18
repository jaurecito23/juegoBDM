<?php

include "funciones/debuguear.php";
include "funciones/database.php";

$nombre = $_GET["nombre"];
$id = intval($_GET["id"]);
$id = filter_var($id,FILTER_VALIDATE_INT);




include "header.php";
?>

<main class='main'>
    <div class="contenido__main">



        <div class="contenedor__intro">
            <p class='intro'>
                Todos los días debes responder una serie de preguntas.
                Al finalizar el día te mostraremos con cuantos colaboradores has
                coincidido.
            </p>
            <p>

                Al finalizar podras conocer quiénes son las personas con muchos
                puntos en común. Quizas sea el inicio de una linda amistad!

            </p>
        </div>

        <div class='contenedor__empezar'>

            <p>Listo! Quiero empezar ya mismo!</p>

        </div>

        <form action='intro3.php??id=<?php echo $id;?>?nombre=<?php echo $nombre; ?>'>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="nombre" value="<?php echo $nombre;?>">
            <input class="btn" type="submit" value="Siguiente">
        </form>
    </div>
</main>


<footer class='footer'>

    <div class="contenido__footer">

        <p>Todos los derechos reservados</p>

    </div>

</footer>


</body>
</html>