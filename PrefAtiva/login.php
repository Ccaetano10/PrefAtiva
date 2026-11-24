<!DOCTYPE html>
<html lang="pt-br">
        <head>
        <meta charset="UTF-8">
        <title>Login | PrefAtiva</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>

    <body>
        <?php require_once "./nav.php"; ?>

        <main class="auth auth-centro">
            <form action="loginbd.php" method="post" enctype="multipart/form-data">
            <h2>Entrar</h2>
            <p class="subtitulo">Acesse para acompanhar suas denúncias</p>

            <?php if (isset($_GET["erro"])): ?>
                <p class="erro">E-mail ou senha incorretos.</p>
            <?php endif; ?>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>

            <p>Não possui uma conta? <a href="./cadastro.php">Cadastre-se</a></p>
            </form>
        </main>

        <?php require_once "./footer.php"; ?>
    </body>
</html>