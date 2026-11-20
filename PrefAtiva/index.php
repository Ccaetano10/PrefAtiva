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
                <p class="subtitulo">Acesse sua conta para acompanhar suas denúncias</p>
                <p class="dica">Clique no mapa para marcar o local do problema.</p>

                <form action="api/salvar_problema.php" method="POST" enctype="multipart/form-data">

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ex.: Buraco na rua" required>

                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Selecione...</option>
                    <option value="1">Buraco</option>
                    <option value="2">Iluminação</option>
                    <option value="3">Lixo</option>
                </select>

                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva o problema" required></textarea>

                <label for="foto">Foto (opcional)</label>
                <input type="file" id="foto" name="foto" accept="image/*">

                <p id="local-selecionado" class="local">Nenhum local selecionado</p>

                <input type="hidden" id="lat" name="latitude" required>
                <input type="hidden" id="lng" name="longitude" required>
                <input type="hidden" id="endereco" name="endereco">

                <?php if (isset($_SESSION['usu_id'])): ?>
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