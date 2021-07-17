<?php 

include "funciones.php";
include "database.php";

$db = conectarDB();


$nombre = $_GET["nombre"];
$id = intval($_GET["id"]);
$id = filter_var($id,FILTER_VALIDATE_INT);

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        header("Location: intro2.php?id=${id}?nombre='${nombre}'");


    }

?>
    <main class='main'>
        <div class="contenido__main">

             <h2 class='hola'> Hola <?php echo $nombre ?>! </h2>
                
                <div class="contenedor__intro">
                    <p class='intro'>
                        Que nos hace únicos y a su vez,
                        que cosa compartimos?                        
                        Con este juego vamos a descubrir que valores
                        forman parte de la amistad para nosotros y con quienes 
                        lo compartimos?
                    </p>                   
                </div>
               
                <div class='contenedor__invitacion'>
                    <p class='invitacion'>
                    ¿ Te animás a jugar y descubrir quienes
                        comparten tus mismos valores ?
                    </p>
                </div>
                <form method="POST" action="intro2.php">
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