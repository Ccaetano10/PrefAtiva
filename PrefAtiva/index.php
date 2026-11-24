<?php
session_start();
require_once "./_conexao.php";

$categorias = $conexao->query("SELECT cat_id, cat_nome FROM categorias ORDER BY cat_nome")->fetchAll(PDO::FETCH_ASSOC);
$cidades    = $conexao->query("SELECT cid_id, cid_nome FROM cidades ORDER BY cid_nome")->fetchAll(PDO::FETCH_ASSOC);

$mensagens = [
    "local"   => "Clique no mapa para marcar o local do problema.",
    "dados"   => "Preencha categoria, cidade, endereço e descrição.",
    "tamanho" => "Algum campo passou do tamanho permitido.",
    "sistema" => "Não foi possível enviar a denúncia. Tente novamente."
];
$erro     = $_GET["erro"] ?? "";
$enviado  = $_GET["enviado"] ?? "";
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PrefAtiva</title>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>

        <?php require_once "./nav.php"; ?>
        
        <main class="container">

            <section class="painel">
                <h2>Reportar problema</h2>
                <p class="dica">Clique no mapa para marcar o local do problema.</p>

                <?php if (isset($mensagens[$erro])): ?>
                <p class="erro"><?= $mensagens[$erro] ?></p>
                <?php endif; ?>

                <?php if ($enviado): ?>
                <p class="sucesso">
                    <?= $enviado === "anonimo" ? "Denúncia enviada anonimamente." : "Denúncia enviada! Acompanhe em Minhas denúncias." ?>
                </p>
                <?php endif; ?>

                <form action="indexbd.php" method="POST" enctype="multipart/form-data">

                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Selecione...</option>
                    <?php foreach ($categorias as $c): ?>
                    <option value="<?= (int) $c["cat_id"] ?>"><?= htmlspecialchars($c["cat_nome"]) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="cidade">Cidade</label>
                <select id="cidade" name="cidade" required>
                    <option value="">Selecione...</option>
                    <?php foreach ($cidades as $c): ?>
                    <option value="<?= (int) $c["cid_id"] ?>"><?= htmlspecialchars($c["cid_nome"]) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva o problema" required></textarea>

                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" placeholder="Ex.: Rua Francisco ..." required>

                <label for="numero">Número (opcional)</label>
                <input type="text" id="numero" name="numero" maxlength="10" placeholder="Ex.: 123">

                <label for="referencia">Ponto de referência (opcional)</label>
                <input type="text" id="referencia" name="referencia" placeholder="Ex.: em frente à padaria">

                <?php if (isset($_SESSION["usu_id"])): ?>
                    <label class="anonimo">
                    <input type="checkbox" name="anonimo" value="1">
                    Enviar anonimamente
                    </label>
                <?php else: ?>
                    <p class="dica">Você não está conectado, então a denúncia será enviada de forma anônima.</p>
                <?php endif; ?>

                <button type="submit">Enviar denúncia</button>
                </form>
            </section>

            <div id="mapa"></div>

        </main>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="js/mapa.js"></script>
    </body>
</html>