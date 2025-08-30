<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "root";
    $banco = "saep_db";

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    //Verifica se houve erro na conexão
    if($conexao->connect_error){
        die("Erro na conexão: " . $conexao->connect_error);
    }

    $conexao->set_charset("utf8");
?>