<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: cadastro.php");
    exit();
}

$nome     = trim($_POST["nome_completo"] ?? "");
$email    = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$telefone = preg_replace("/\D/", "", $_POST["telefone"] ?? ""); // só números
$senha1   = $_POST["senha1"] ?? ""; // senha nunca é sanitizada
$senha2   = $_POST["senha2"] ?? "";

if ($nome === "" || !$email) {
    header("Location: cadastro.php?erro=dados");
    exit();
}

// telefone é opcional; se vier preenchido, precisa ter 10 ou 11 dígitos (DDD + número)
if ($telefone !== "" && !in_array(strlen($telefone), [10, 11])) {
    header("Location: cadastro.php?erro=telefone");
    exit();
}

if (strlen($senha1) < 8) {
    header("Location: cadastro.php?erro=curta");
    exit();
}

if ($senha1 !== $senha2) {
    header("Location: cadastro.php?erro=diferentes");
    exit();
}

try {
    require_once "./_conexao.php";

    $verifica = $conexao->prepare("SELECT usu_id FROM usuarios WHERE usu_email = :email");
    $verifica->bindValue(":email", $email);
    $verifica->execute();

    if ($verifica->fetch()) {
        header("Location: cadastro.php?erro=duplicado");
        exit();
    }

    $comandoSQL = $conexao->prepare("INSERT INTO usuarios
        (usu_nome, usu_email, usu_telefone, usu_senha, usu_tipo)
        VALUES
        (:usu_nome, :usu_email, :usu_telefone, :usu_senha, :usu_tipo)");

    $comandoSQL->execute([
        ":usu_nome"     => $nome,
        ":usu_email"    => $email,
        ":usu_telefone" => $telefone !== "" ? $telefone : null,
        ":usu_senha"    => password_hash($senha1, PASSWORD_DEFAULT),
        ":usu_tipo"     => "usuario"
    ]);

    header("Location: login.php?cadastro=ok");
    exit();

} catch (PDOException $erro) {
    echo "ERRO: " . $erro->getMessage(); // só para testar, remova depois
    exit();
}