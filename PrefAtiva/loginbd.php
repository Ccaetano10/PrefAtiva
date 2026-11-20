<?php

session_start();

require_once "_conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login = $_POST["usuario"];
    $senha = $_POST["senha1"];

    $sql = "SELECT * FROM usuario WHERE usu_login = :login";

    // guarda em comandoSQL a preparação para executar
    $comandoSQL = $conexao->prepare($sql);

    // preenche o :login com o que foi digitado no login
    $comandoSQL->bindValue(":login", $login);

    // executa o comandoSQL
    $comandoSQL->execute();

    // usuario vai receber um array com todas informações do usuario encontrado
    $usuario = $comandoSQL->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {

        if (password_verify($senha, $usuario["usu_senha"])) {

            $_SESSION["usu_id"] = $usuario["usu_id"];
            $_SESSION["usu_login"] = $usuario["usu_login"];
            $_SESSION["usu_tipo"] = $usuario["usu_tipo"];
            $_SESSION["tempo_secao"] = time() + 120;

            if ($usuario["usu_tipo"] == "admin") {

                header("Location: admin1/visualizar.php");
                exit();

            } else {

                header("Location: usuario/visualizar.php");
                exit();
            }

        } else {

            echo "Senha incorreta.";
        }

    } else {

        echo "Usuário não encontrado.";
    }
}
?>