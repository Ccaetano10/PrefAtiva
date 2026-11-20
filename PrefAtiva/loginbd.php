<?php

session_start();

require_once "_conexao.php";

// se abrir o arquivo direto pelo navegador, volta para o login
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit();
}

$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";

$sql = "SELECT * FROM usuarios WHERE usu_email = :email";
$comandoSQL = $conexao->prepare($sql);
$comandoSQL->bindValue(":email", $email);
$comandoSQL->execute();

$usuario = $comandoSQL->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($senha, $usuario["usu_senha"])) {

    session_regenerate_id(true); // evita fixação de sessão

    $_SESSION["usu_id"]      = $usuario["usu_id"];
    $_SESSION["usu_login"]   = $usuario["usu_login"];
    $_SESSION["usu_tipo"]    = $usuario["usu_tipo"];
    $_SESSION["tempo_secao"] = time() + 120;

    if ($usuario["usu_tipo"] == "admin") {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
    exit();
}

// mensagem única, sem dizer se foi o e-mail ou a senha que errou
header("Location: login.php?erro=1");
exit();