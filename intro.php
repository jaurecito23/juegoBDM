<?php

include "funciones/debuguear.php";
include "funciones/database.php";

$db = conectarDB();


$nombre = $_GET["nombre"];
$id = intval($_GET["id"]);
$id = filter_var($id,FILTER_VALIDATE_INT);

?>
<main class='main'>
    <div class="contenido__main">

        <h2 class='hola'> Hola <?php echo $nombre ?>! </h2>

        <div class="contenedor__intro">
            <p class='intro'>
                ¿Qué nos hace únicos y a su vez,
                que cosa compartimos?
                ¿Con este juego vamos a descubrir que valores
                forman parte de la amistad para nosotros y con quienes
                lo compartimos?
            </p>
        </div>

        <div class='contenedor__invitacion'>
            <p class='invitacion'>
                ¿Te animás a jugar y descubrir quienes
                comparten tus mismos valores?
            </p>
        </div>
        <form action="intro2.php">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="hidden" name="nombre" value="<?php echo $nombre ?>">
            <input class='btn' type="submit" value="Siguiente">
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