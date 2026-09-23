<?php

$url = "http://jsonplaceholder.typicode.com/users/";
$string = file_get_contents($url);
$json_array = json_decode($string, true);

echo "<pre>";
print_r($json_array);
echo "</pre>";

?>