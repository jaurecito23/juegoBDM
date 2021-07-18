<?php

include "funciones/debuguear.php";
include "funciones/database.php";

$db = conectarDB();

$nombre = $_GET["nombre"];
$id = intval($_GET["id"]);
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
        $imagen = $_FILES["image"]["tmp_name"] ?? NULL;



        if(!isset($apodoSeleccionado)){

            $errores[] = "Debe seleccionar un apodo";

        }

        if(!isset($imagen)){

            $errores[] = "Debe seleccionar una imagen de perfil";

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

                $carpetaImagen = "imagenes/fotodeperfil";

                if(!is_dir($carpetaImagen)){

                        mkdir($carpetaImagen);
                }

                move_uploaded_file()



                //Almacenar Nombre de Imagen

                $query = "UPDATE users SET imagen='$nombreImagen' WHERE id='${id}';";
                $resultado = mysqli_query($db,$query);




                if($resultado){

                    header("Location: intro3.php?id=${id}?nombre='${nombre}'");


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
                <h2 class='hola'> Al comiénzo nadie sabe quien sos.
                    Elegí un apodo. </h2>

                <div class="contenido__select">
                    <select name="apodo" class='select'>
                        <option disabled selected>--Seleccionar Apodo--</option>
                        <?php foreach($apodos as $apodo):?>
                        <option <?php echo $apodoSeleccionado === $apodo  ? "selected" : " "?>><?php echo $apodo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class='contenido__foto'>
                    <p>
                        Sube una foto tuya. No te preocupes la mostraremos blureada(borrosa).
                    </p>
                </div>



                <legend>Subir Foto</legend>
                <input type='file' name="image" placeholder="Subir Foto">
                <input class='btn' type="submit" value="Siguiente">
            </form>
        </div>

    </div>
    </div>
</main>


<footer class='footer'>

    <div class="contenido__footer">

        <p>Todos los derechos reservados</p>

    </div>

</footer>


</body>
</html>