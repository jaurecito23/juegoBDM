<?php

    include "funciones/database.php";
    include "funciones/debuguear.php";

    $db = conectarDB();

    $query ="SELECT * FROM respuestas";
    $resultado = mysqli_query($db, $query);

    $grupos=[

        "AAA" => [],
        "ABA" => [],
        "AAB"=> [],
        "BAA" => [],
        "BBB" => [],
        "BAB" => [],
        "BBA" => [],
        "ABB" => []


    ];

$cantidades = [

    "AAA" => 0,
    "ABA" => 0,
    "AAB" => 0,
    "BAA" => 0,
    "BBB" => 0,
    "BAB" => 0,
    "BBA" => 0,
    "ABB" => 0

];



    foreach ($resultado as $user) {

     $grupo = $user["grupo"];

     if($grupo === "AAA"){

        $grupos["AAA"][] = $user["usuarioId"];
        $cantidades["AAA"] += 1;
     }
     if($grupo === "ABA"){

        $grupos["ABA"][] = $user["usuarioId"];
        $cantidades["ABA"] += 1;
     }

     if($grupo === "AAB"){

        $grupos["AAB"][] = $user["usuarioId"];
        $cantidades["AAB"] += 1;
    }
    if($grupo === "BAA"){

        $grupos["BAA"][] = $user["usuarioId"];
        $cantidades["BAA"] += 1;
    }
    if($grupo === "BBB"){

        $grupos["BBB"]= $user["usuarioId"];
        $cantidades["BBB"] += 1;
    }
    if($grupo === "BAB"){

        $grupos["BAB"][] = $user["usuarioId"];
        $cantidades["BAB"] += 1;
    }
    if($grupo === "BBA"){

        $grupos["BBA"][] = $user["usuarioId"];
        $cantidades["BBA"] += 1;
    }
    if($grupo === "ABB"){

        $grupos["ABB"][] = $user["usuarioId"];
        $cantidades["ABB"] += 1;
    }
    }



    $day = date("l");
    $dia = "";
    $dias = [
        "Monday" =>"Lunes",
        "Tuesday" =>"Martes",
        "Wednesday" =>"Miercoles",
        "Thursday"=>"Jueves",
        "Friday"=>"Viernes",
        "Saturday"=>"Sabado",
        "Sunday"=>"Domingo"
    ];

    foreach ($dias as $key => $value) {

        if($key == $day){

            $dia = $value;

        }

    }


    // foreach ($cantidades as $grupo => $value) {

    //     $query = "INSERT INTO grupos_${dia} "


    // }

    foreach ($grupos as $grupo => $value) {

        $cantidad = $cantidades[$grupo];
        $arrayUsers = implode(",",$value);
        $query = "INSERT INTO grupos_${dia} (grupo,users,cantidad) VALUES('${grupo}','${arrayUsers}','${cantidad}');";
         $resultado = mysqli_query($db,$query);

    }




include "header.php";
?>


<main>

    <table>
        <thead>

            <th>GRUPO</th>
            <th>CANTIDAD</th>
        </thead>
        <tbody>
            <?php foreach($grupos as $grupo => $value):?>
            <tr>
                <td><?php echo $grupo?></td>
                <td><?php echo $cantidades[$grupo]?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</main>