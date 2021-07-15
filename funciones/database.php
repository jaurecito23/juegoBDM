<?php

function conectarDB(){


    $db = mysqli_connect("localhost","root","root","juego");

if(!$db){

    echo "No se pudo Conectar";

}else{


    return $db;

}


  }


?>