
<?php 

include "funciones.php";
include "database.php";

$db = conectarDB();
$nombre = "Ingrese un Legajo";
$legajoIngresado =  $_POST['legajo'] ?? null;
// Display de los form;
$post = false;

//Id del usuario
$id = intval($_POST["id"]) ?? null;

if($_SERVER["REQUEST_METHOD"==="POST"]){

    $id = filter_var($id,FILTER_VALIDATE_INT) ?? null;

    if(isset($id) && isset($legajoIngresado)){

        header("Location: intro.html");

    }else{

        
    $legajoIngresado = $_POST["legajo"];
    $query = "SELECT * FROM users WHERE legajo = '${legajoIngresado}';";
    $resultado = mysqli_query($db,$query);
    
    
    //Obtener el usuario
    
    if($resultado){
        
        // Iniciar una session en el server
        $post = true;
        
        

        foreach($resultado as $usuario){
            
            $nombre = $usuario["nombre"];
            $id = $usuario["id"];
            
        }
        
        
        }else{
            
            echo "El legajo ingresado no es correcto";
            
        }    
    }
}


include "header.php";
?>


<main class='main'>
    
        <div class='contenido__main'>

            <h1 class='titulo_main'> Bienvenidos </h1>

            <div class='contenedor__form'>

                <form class='<?php $post ? "oculto" : ""?> form__main form_legajo' method="POST">
                    <fieldset>
                        <div>
                            <input type='text' value=<?php echo $legajoIngresado ?> placeholder="Ingrese Su Legajo"> 
                        </div>
                            <input class='btn' type='submit' value='Buscar'>
                    </fieldset>
                </form>
                <form class="<?php $post ? "" : "oculto"?> form_ingresar">
                        
                        <div>
                            <input type='text' value=<?php echo $legajoIngresado ?> placeholder="Ingrese Su Legajo"> 
                        </div>
                    
                        <div>
                            <input type='text' placeholder="<?php echo $nombre;?>">
                        </div>

                        <p>Si su nombre es correcto presione entrar: </p>
                        
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


</body>
</html>