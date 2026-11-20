<?php

$dns = "mysql:host=127.0.0.1;dbname=prefativa;charset=utf8";
$user = "root";
$pass = "";

try {
    $conexao = new PDO($dns, $user, $pass);
    // echo("Conexão realizada com sucesso!!");
    // $conexao = null; // fechando a conexão
} 
catch (PDOException $erro) {
    echo("Entre em contato com o suporte!!");
    // echo("Código do erro: ".$erro->getCode());
    // echo("Descrição do erro: ".$erro->getMessage());

    //PERIGO!!
    // echo("<pre>");
    // print_r($erro);
    // echo("</pre>");
}