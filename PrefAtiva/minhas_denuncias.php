<?php
require_once "./protege.php";
require_once "./_conexao.php";

$sql = "SELECT p.pro_id, p.pro_descricao, p.pro_status, p.pro_data_cadastro,
               p.pro_endereco, p.pro_numero,
               c.cat_nome, ci.cid_nome
        FROM problemas p
        INNER JOIN categorias c ON c.cat_id = p.cat_id
        INNER JOIN cidades ci ON ci.cid_id = p.cid_id
        WHERE p.usu_id = :usu_id
        ORDER BY p.pro_data_cadastro DESC";

$comandoSQL = $conexao->prepare($sql);
$comandoSQL->bindValue(":usu_id", $_SESSION["usu_id"], PDO::PARAM_INT);
$comandoSQL->execute();

$denuncias = $comandoSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Minhas denúncias | PrefAtiva</title>

        <link rel="stylesheet" href="./css/estilo.css">
    </head>

    <body>
        <?php require_once "./nav.php"; ?>

        <main class="pagina">
            <h2>Minhas denúncias</h2>
            <p class="subtitulo">Acompanhe os problemas que você reportou.</p>

            <?php if (!$denuncias): ?>
                <div class="vazio">
                    <p>Você ainda não fez nenhuma denúncia identificada.</p>
                    <a href="index.php" class="btn-link">Reportar um problema</a>
                </div>
            <?php else: ?>
                <div class="tabela-wrap">
                    <table class="tabela">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Categoria</th>
                            <th>Descrição</th>
                            <th>Endereço</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($denuncias as $d): ?>
                            <tr>
                                <td>#<?= (int) $d["pro_id"] ?></td>
                                <td><?= htmlspecialchars($d["cat_nome"]) ?></td>
                                <td><?= htmlspecialchars(mb_strimwidth($d["pro_descricao"] ?? "", 0, 60, "...")) ?></td>
                                <td>
                                    <?= htmlspecialchars($d["pro_endereco"] . ($d["pro_numero"] ? ", " . $d["pro_numero"] : "")) ?>
                                    <br><small><?= htmlspecialchars($d["cid_nome"]) ?></small>
                                </td>
                                <td><?= date("d/m/Y", strtotime($d["pro_data_cadastro"])) ?></td>
                                <td><span class="status"><?= htmlspecialchars($d["pro_status"] ?? "Enviada") ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            <?php endif; ?>
        </main>
    </body>
</html>