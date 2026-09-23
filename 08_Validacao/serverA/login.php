<?php
session_save_path("../central");
session_start();

$_SESSION["usuario"] = "Jaclede";
echo "login efetuado com sucesso!";

?>