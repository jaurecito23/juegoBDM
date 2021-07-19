<?php

include "funciones/debuguear.php";
include "funciones/database.php";

$db = conectarDB();
$nombre = "";
$legajoIngresado =  $_POST['legajo'] ?? null;
// Display de los form;
$post = false;
$errores = [];
//Id del usuario

$id = null;



if($_SERVER["REQUEST_METHOD"]==="POST"){

        $legajoIngresado = $_POST["legajo"];
        $query = "SELECT * FROM users WHERE legajo = '${legajoIngresado}';";
        $resultado = mysqli_query($db,$query);



//Obtener el usuario
        if($resultado){

            if($resultado -> num_rows === 0){


                    $errores[] = "El legajo es Incorrecto";




                }else{

                    $post = true;
                        // Iniciar una session en el server

                        foreach ($resultado as $usuario) {
                            $nombre = $usuario["nombre"];
                            $id = $usuario["id"];


                            }

           }

        }else{

            $errores[] = "Hubo un error al buscar tu usuario";
            $errores[] = "Vuelve a intentarlo o comunicate con el administrador";

        }
    }
// }


include "headerlogin.php";
?>



<main class='main'>

    <?php foreach($errores as $error):?>
    <div class="alerta">

        <p> <?php echo $error; ?> </p>

    </div>

    <?php endforeach; ?>

    <div class='contenido__main'>

        <h1 class='titulo_main'> Bienvenidos </h1>

        <div class='contenedor__form'>



            <form class='<?php echo $post ? "oculto" : "";?> form__main form_legajo' method="POST">
                    <fieldset>
                        <div>
                            <input type='text' class="input" value='<?php echo $legajoIngresado ?>' placeholder="Ingrese Su Legajo">
                        </div>
                            <input class='btn btn-cuadrado' type='submit' value='Buscar'>
                    </fieldset>
                </form>



            <form class="<?php echo $post ? "" : "oculto"?> form_ingresar">

                        <div>
                            <input type='text' class="input" value="<?php echo $legajoIngresado?>" placeholder="Ingrese Su Legajo">
                        </div>

                        <div>
                        <p><?php echo $nombre;?></p>
                        </div>

                        <p class="no-soy">No soy yo - contactar al administrador </p>

                        <div>
                            <input type="hidden" value="<?php echo $id?>">
                            <input class='btn' type='submit' value='Entrar'>
                        </div>

                </form>

        </div>
    </div>
</main>



<footer class='footer'>

    <div class="contenido__footer">

        <p>Todos los derechos reservados</p>

    </div>

</footer>


<script src="build/js/bundle.min.js"></script>

</body>
</html>