<?php
$mensagens = [
    "dados"      => "Preencha o nome e informe um e-mail válido.",
    "telefone"   => "Informe o telefone com DDD, por exemplo (18) 99999-9999.",
    "curta"      => "A senha precisa ter pelo menos 8 caracteres.",
    "diferentes" => "As senhas não conferem.",
    "duplicado"  => "Este e-mail já está cadastrado.",
    "sistema"    => "Não foi possível concluir o cadastro. Tente novamente."
];
$erro = $_GET["erro"] ?? "";
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro | PrefAtiva</title>

        <link rel="stylesheet" href="./css/estilo.css">
    </head>

    <body>
        <?php require_once "./nav.php"; ?>

        <main class="auth auth-centro">
            <form action="cadastrobd.php" method="post">
                <h2>Criar conta</h2>
                <p class="subtitulo">Cadastre-se para acompanhar suas denúncias</p>

                <?php if (isset($mensagens[$erro])): ?>
                    <p class="erro"><?= $mensagens[$erro] ?></p>
                <?php endif; ?>

                <label for="nome_completo">Nome completo</label>
                <input type="text" id="nome_completo" name="nome_completo"
                    placeholder="Seu nome completo" required>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email"
                    placeholder="seuemail@exemplo.com" required>

                <label for="telefone">Telefone (opcional)</label>
                <input type="tel" id="telefone" name="telefone"
                    placeholder="(18) 99999-9999">

                <label for="senha1">Senha</label>
                <input type="password" id="senha1" name="senha1" minlength="8"
                    placeholder="Mínimo de 8 caracteres" required>

                <label for="senha2">Confirme a senha</label>
                <input type="password" id="senha2" name="senha2" minlength="8"
                    placeholder="Repita a senha" required>

                <button type="submit">Cadastrar</button>

                <p>Já possui uma conta? <a href="login.php">Entrar</a></p>
            </form>
        </main>
    </body>
</html>