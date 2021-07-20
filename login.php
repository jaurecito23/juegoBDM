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
$registrado = false;



$date=date("H");
$date = intval($date);





session_start();
if(isset($_SESSION["loginBDM"])){

    if($_SESSION["loginBDM"] === true){

        if($date > 20 || $date < 8){

            header("Location: coincidencias.php");

          }elseif($_SESSION["registrado"] === true ){


            header("Location: cuestionario.php");

        }else{

            header("Location: intro3.php");

        }

    }

}



if($_SERVER["REQUEST_METHOD"]==="POST"){

        $legajoIngresado = $_POST["legajo"];
        $apodo = "";
        $query = "SELECT * FROM users WHERE legajo = '${legajoIngresado}';";
        $resultado = mysqli_query($db,$query);



//Obtener el usuario
        if($resultado){

            if($resultado -> num_rows === 0){


                    $errores[] = "El legajo es Incorrecto";




                }else{


                        // Iniciar una session en el server

                        foreach ($resultado as $usuario) {
                            $nombre = $usuario["nombre"];
                            $id = $usuario["id"];

                            $registrado = $usuario["registrado"];

                        }

                        $_SESSION["id"] = $id;
                        $_SESSION["loginBDM"] = true;

                        if($date > 20 || $date < 8){

                            header("Location: coincidencias.php");

                          }else if ($registrado == 1){

                              header("Location: cuestionario.php");

                          }


                        $post = true;
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



            <form class='<?php echo $post ? "oculto" : "";?> form__main form_legajo' method="POST" >
                    <fieldset>
                        <div>
                            <input type='text' name="legajo" class="input" value='<?php echo $legajoIngresado ?>' placeholder="Ingrese Su Legajo">
                        </div>
                            <input class='btn btn-cuadrado' type='submit' value='Buscar'>
                    </fieldset>
                </form>



                  <form class="<?php echo $post ? "" : "oculto"?> form_ingresar"        action="intro.php" >

                        <div>
                            <input type='text' name="legajo" class="input" value="<?php echo $legajoIngresado?>" placeholder="Ingrese Su Legajo">
                        </div>

                        <div>
                        <p class="input"><?php echo $nombre;?></p>
                        </div>

                        <p class="no-soy">No soy yo - <a href="#">contactar al administrador &raquo;</a> </p>

                        <div>
                        <!-- <input type="hidden" name="id" value="<?php echo $id?>"> -->

                            <input class='btn' type='submit' value='Entrar'>
                        </div>

                </form>



        </div>
    </div>
</main>




<?php include "footer.php"?>

<script src="build/js/bundle.min.js"></script>

</body>
</html>