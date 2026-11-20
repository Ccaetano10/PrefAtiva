<!DOCTYPE html>
<html lang="pt-br">
        <head>
        <meta charset="UTF-8">
        <title>Login | PrefAtiva</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>

    <body>
        <?php require_once "./PrefAtiva/nav.php"; ?>

        <main class="auth">
            <form action="loginbd.php" method="post" enctype="multipart/form-data">
            <h2>Entrar</h2>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
            </form>
        </main>
    </body>
</html>