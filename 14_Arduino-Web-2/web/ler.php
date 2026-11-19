<?php
header('Content-Type: application/json');

$url = "https://aquario-7d5f2-default-rtdb.firebaseio.com/aquario.json?auth=xtMBVwkSiBWh3IsrSeXF6dD5OLIi772tWxT3HUjK";

$dados = file_get_contents($url);

echo $dados;

?>