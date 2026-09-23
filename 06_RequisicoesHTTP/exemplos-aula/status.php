<?php

http_response_code(201);
header('Content-type: text/json');
echo json_encode(['status' => 201, 'Mensagem' => 'A requisição foi um sucesso']);

?>