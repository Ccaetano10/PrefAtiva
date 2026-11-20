<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sobre | PrefAtiva</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/sobre.css">
    </head>

    <body>

        <?php require_once "./nav.php"; ?>

        <header class="hero">
            <h2>Conectando cidadãos e prefeitura</h2>
            <p>
            O PrefAtiva é uma plataforma web para que qualquer pessoa possa reportar
            problemas urbanos diretamente no mapa da cidade.
            </p>
        </header>

        <main class="sobre">

            <section class="bloco">
            <h3>O que é o PrefAtiva?</h3>
            <p>
                Buracos, falta de iluminação, lixo acumulado e outros problemas do dia a dia
                nem sempre chegam ao conhecimento do poder público. O PrefAtiva cria um canal
                simples e direto: o cidadão marca o local no mapa, descreve o problema, anexa
                uma foto e envia a denúncia.
            </p>
            </section>

            <section class="bloco">
            <h3>Como funciona</h3>
            <div class="passos">
                <div class="passo">
                <span class="numero">1</span>
                <h4>Marque o local</h4>
                <p>Clique no mapa e o sistema identifica automaticamente o endereço.</p>
                </div>
                <div class="passo">
                <span class="numero">2</span>
                <h4>Descreva o problema</h4>
                <p>Escolha a categoria, informe os detalhes e, se quiser, envie uma foto.</p>
                </div>
                <div class="passo">
                <span class="numero">3</span>
                <h4>Acompanhe</h4>
                <p>As denúncias ficam registradas e ajudam a mostrar onde a cidade mais precisa de atenção.</p>
                </div>
            </div>
            </section>

            <section class="bloco">
            <h3>Nossos objetivos</h3>
            <ul class="lista">
                <li>Facilitar a comunicação entre população e prefeitura.</li>
                <li>Dar transparência aos problemas urbanos já reportados.</li>
                <li>Ajudar a prefeitura a priorizar ações com base em dados, como o mapa de calor.</li>
                <li>Incentivar a participação do cidadão no cuidado com a cidade.</li>
            </ul>
            </section>

            <section class="bloco">
            <h3>Tecnologias utilizadas</h3>
            <div class="tags">
                <span>PHP</span>
                <span>JavaScript</span>
                <span>SQL</span>
                <span>HTML</span>
                <span>CSS</span>
                <span>Leaflet</span>
                <span>OpenStreetMap</span>
            </div>
            </section>

            <section class="bloco">
            <h3>Sobre o projeto</h3>
            <p>
                O PrefAtiva foi desenvolvido como Trabalho de Conclusão de Curso (TCC).
                Para sugestões, dúvidas ou parcerias, acesse a página de
                <a href="contato.php">contato</a>.
            </p>
            </section>

        </main>

        <footer class="rodape">
            <p>&copy; <?php echo date('Y'); ?> PrefAtiva. Todos os direitos reservados.</p>
        </footer>

    </body>
</html>