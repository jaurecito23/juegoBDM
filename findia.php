<?php

    include "funciones/database.php";
    include "funciones/debuguear.php";

    $db = conectarDB();

$id = $_GET["id"];

$query = "SELECT * FROM users WHERE id = '${id}'";
$resultado = mysqli_query($db,$query);
$apodo = "";
$imagen = "";

foreach ($resultado as $user) {
    $apodo = $user["apodo"];
    $imagen = $user["imagen"];
}

include "header.php";

?>


<main class='main'>
    <div class="contenido__main">

        <div>
            <p>
                Las nuevas preguntas estaran disponible
                mañana a las 8.
            </p>
        </div>

        <div>
            <p>
                Mostraremos los resultados a las 21 hs
            </p>
        </div>






        <footer class='footer'>

            <div class="contenido__footer">

                <p>Todos los derechos reservados</p>

            </div>

        </footer>


        </body>
        </html>