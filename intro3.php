<?php

include "funciones/debuguear.php";
include "funciones/database.php";

$db = conectarDB();

session_start();
$id = intval($_SESSION["id"]);
$id = filter_var($id,FILTER_VALIDATE_INT);
$errores = [];
$apodos = [];
$query= "SELECT * FROM apodos;";
$resultado= mysqli_query($db,$query);
$apodoSeleccionado = null;


foreach($resultado as $apodo){

    $apodos[] = $apodo["apodos"];

}







    if($_SERVER["REQUEST_METHOD"] === "POST"){

        // Validar la imagen y el apodo

        $apodoSeleccionado = $_POST["apodo"] ?? NULL;
        $imagen = $_FILES["image"] ?? NULL;



        if(!isset($apodoSeleccionado)){

            $errores[] = "Debe seleccionar un apodo";

        }


        if($imagen["tmp_name"]===""){

            $errores[] = "Debe seleccionar una imagen";

        }

        if(empty($errores)){

            // Subir Apodo a database

            $query = "UPDATE users SET apodo='${apodoSeleccionado}' WHERE id='${id}';";
            $resultado = mysqli_query($db , $query);

            if($resultado){
                //Subir imagen

                //Subir Imagen a server

                $nombreImagen = md5(uniqid(rand(),true));
                $nombreImagen .= ".jpg";


                //Almacenar Imagen en server

                $carpetaImagen = "imagenes/fotodeperfil/";

                if(!is_dir($carpetaImagen)){

                        mkdir($carpetaImagen);
                }




                move_uploaded_file($imagen["tmp_name"],$carpetaImagen.$nombreImagen);



                //Almacenar Nombre de Imagen

                $query = "UPDATE users SET imagen='$nombreImagen' WHERE id='${id}';";
                $resultado = mysqli_query($db,$query);




                if($resultado){

                        $query="UPDATE users SET registrado='1' WHERE id='${id}';";
                          $resultado = mysqli_query($db,$query);
                            $_SESSION["registrado"] = true;

                    header("Location: cuestionario.php");


                }
            }



        }


    }


include "header.php";
?>

<?php foreach($errores as $error):?>
<div class="alerta">

    <p> <?php echo $error; ?> </p>

</div>

<?php endforeach; ?>
<main class='main'>
    <div class="contenido__main">



        <div class="contenido__form">
            <form class="form" method="POST" enctype="multipart/form-data">
                <h2 class='titulo'> Elegí un apodo.</h2>
                <p class="texto">Nadie sabrá quien sos hasta finalizar. Elegí un apodo para participar.</p>

                <div class="form_intro">

                    <div class="contenido__select">
                        <select class="input" name="apodo" class='select'>
                            <option class="input" disabled selected>--Seleccionar Apodo--</option>
                            <?php foreach($apodos as $apodo):?>
                            <option <?php echo $apodoSeleccionado === $apodo  ? "selected" : " "?>><?php echo $apodo; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='contenido__foto'>

                        <p class="titulo">Subí tu foto.</p>
                        <p class="texto">
                            Estará blureada asi no te reconocen hasta el final.
                        </p>
                    </div>

                </div>
                <div class="subir">
                    <label for="inputimagen">

                        Elegir archivo

                    </label>

                    <input type='file' class="oculto" id="inputimagen" name="image" placeholder="Subir Foto">
                </div>
                <input class='btn' type="submit" value="Siguiente">
            </form>
        </div>

    </div>
    </div>
</main>


<?php include "footer.php"?>

</footer>


</body>
</html>