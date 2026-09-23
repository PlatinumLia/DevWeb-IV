<?php

$conteudo_json = file_get_contents('escola.json');
// echo "<hr> Formato Array:";
// echo "<pre>";
// var_dump($conteudo_json);
// echo "</pre>";

$dados_obj = json_decode($conteudo_json);
$dados_array = json_decode($conteudo_json, true);
// echo "<hr> Formato JSON:";
// echo "<pre>";
// print_r($dados);
// echo "</pre>";

// echo "Nome do aluno: " . $dados_array["alunos"][0]['nome'] . "<br>";
// echo "Nome do aluno: " . $dados_obj->alunos[1]->nome . "<br>";

if($_POST){
    $encontrou = false;

    foreach($dados_array["alunos"] as $dados){
        if($_POST["nome"] === $dados["nome"]){
            echo "Nome do aluno: " . $dados['nome'] . "<br>";
            echo "Turma: " . $dados['turma'] . "<br>";
            echo "Status: " . $dados['status'] . "<br>";
            
            foreach($dados["boletim"] as $boletim){
                echo "<br> Matéria: " . $boletim['materia'] . "<br>" . "Nota: " . $boletim['nota'] . "<br><br>";
            }
        
            echo "<hr>";
        }
    }

    if(!$encontrou){
        echo "Aluno não encontrado.";
    }
}


?>

<form action="" method="POST">
    <input type="text" name="nome" placeholder="Nome">
    <button type="submit">Enviar</button>
</form>