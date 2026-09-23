<?php

// session_save_path(__DIR__);
// session_start();

// if(isset($_SESSION["usuario"])){ // O serverB não consegue ler a sessão por que ela esta no serverA
//     echo "Bem-vindo" . $_SESSION["usuario"];
// }
// else{
//     echo "Erro no server B: Usuario não autenticado!";
// }

session_save_path("../central");
session_start();

if(isset($_SESSION["usuario"])){ 
    echo "Bem-vindo, " . $_SESSION["usuario"];
}
else{
    echo "Erro no server B: Usuario não autenticado!";
}


?>