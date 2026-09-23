<?php

function respotasJson($dados, $statusCode = 200){
    http_response_code($statusCode);
    header('Content-type: application/json');
    echo json_encode($dados);
    
    exit;
}

?>