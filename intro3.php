<?php

include "funciones.php";
include "database.php";

$db = conectarDB();

$nombre = $_GET["nombre"];
$id = intval($_GET["id"]);
$id = filter_var($id,FILTER_VALIDATE_INT);
$errores = [];


    if($_SERVER["REQUEST_METHOD"] === "POST"){

        // Validar la imagen y el apodo

        $apodo = $_POST["apodo"] ?? NULL;
        $imagen = $_FILE["tmp_name"]["imagen"] ?? NULL;

        if(!isset($apodo)){

            $errores[] = "Debe seleccionar un apodo";

        }

        if(!isset($imagen)){

            $errores[] = "Debe seleccionar una imagen de perfil";

        }

        if(empty($errores)){

            // Subir Apodo a database

            $query = "INSERT INTO users WHERE id=${id} (ficticio='$apodo');";
            $resultado = mysqli_query($db , $query);

            if($resultado){
                //Subir imagen 

                //Subir Imagen a server
               // $nombreImagen = md5(unique_id());

                //Almacenar Nombre de Imagen

                $query = "INSERT INTO users WHERE id=${id} (imagen='$nombreImagen')";
                $resultado = mysqli_query($db,$query);

                if($resultado){
                    
                    header("Location: intro3.php?id=${id}?nombre='${nombre}'");
                    
                } 
            }



        }


    }


include "header.php";
?>


    <main class='main'>
        <div class="contenido__main">

            <div class="contenido__form">
            
                <h2 class='hola'> Al comienzo nadie sabe quien sos. 
                    Elegí un apodo </h2>

                <div class="contenido__select">
                    <select class='select'> 
                        <option disabled selected>--Seleccionar Apodo--</option>
                        <option>cocaZero</option>
                        <option>apodoApodo</option>
                        <option>apodoApodo</option>
                    </select>
                </div>
                    
                <div class='contenido__foto'>
                    <p>
                        Subi una foto tuya. No te preocupes la mostraremos blureada.
                    </p>
                </div>
            

                <form class="form"> 
                        <legend>Subir Foto</legend>
                        <input type='file' placeholder="Subir Foto">  
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